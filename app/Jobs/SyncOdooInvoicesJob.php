<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Services\OdooService;
use App\Models\OdooSyncLock;
use App\Models\OdooSyncRun;
use App\Models\OdooInvoice;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class SyncOdooInvoicesJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $timeout = 900;
    public $tries = 3;

    public function handle(OdooService $odoo)
    {
        $startTime = now();
        $model = 'primavera.invoice';

        Log::info('Odoo invoice sync requested', [
            'model' => $model,
            'started_at' => $startTime->toDateTimeString(),
        ]);

        /**
         * STEP 1 — Acquire lock
         */
        DB::beginTransaction();
        $lock = OdooSyncLock::lockForUpdate()->firstOrCreate(['model' => $model]);

        if ($lock->status === 'running') {
            DB::rollBack();

            Log::warning('Odoo invoice sync skipped — already running', [
                'model' => $model,
                'started_at' => $lock->started_at,
            ]);
            return;
        }

        $lock->update([
            'status' => 'running',
            'started_at' => $startTime,
        ]);

        DB::commit();

        Log::info('Odoo invoice sync lock acquired', [
            'model' => $model,
            'lock_id' => $lock->id,
        ]);

        /**
         * STEP 2 — Create audit run
         */
        $run = OdooSyncRun::create([
            'model' => $model,
            'status' => 'running',
            'started_at' => $startTime,
            'total_records_synced' => 0,
            'last_batch_count' => 0,
        ]);

        Log::info('Odoo invoice sync run created', [
            'run_id' => $run->id,
        ]);

        try {
            $this->sync($odoo, $run);

            $duration = $startTime->diffInSeconds(now());

            $run->update([
                'status' => 'success',
                'finished_at' => now(),
            ]);

            $lock->update([
                'status' => 'idle',
                'last_sync_at' => Carbon::now('UTC'),
            ]);

            Log::info('✅ Odoo invoice sync completed successfully', [
                'run_id' => $run->id,
                'duration_seconds' => $duration,
                'total_records_synced' => $run->total_records_synced,
            ]);

        } catch (\Throwable $e) {

            $run->update([
                'status' => 'failed',
                'finished_at' => now(),
                'last_error' => $e->getMessage(),
            ]);

            $lock->update(['status' => 'idle']);

            Log::error('❌ Odoo invoice sync failed', [
                'run_id' => $run->id,
                'exception' => $e,
            ]);

            throw $e;
        }
    }

    protected function sync(OdooService $odoo, OdooSyncRun $run)
    {
        /**
         * Current month filter
         */
        $monthStart = Carbon::now()->startOfMonth()->toDateString();
        $monthEnd = Carbon::now()->endOfMonth()->toDateString();

        $domain = [
            ['invoice_code', '=', 'FA'],
            ['invoice_date', '>=', $monthStart],
            ['invoice_date', '<=', $monthEnd],
        ];

        $fields = [
            'id',
            'partner',
            'partner_ref',
            'doc_ref',
            'invoice_date',
            'invoice_date_due',
            'state',
            'currency_id',
            'amount_total',
            'balance',
            'name',
            'document_code',
            'create_uid',
            'write_date',
        ];

        Log::info('Invoice sync domain prepared', [
            'run_id' => $run->id,
            'domain' => $domain,
            'fields' => $fields,
        ]);

        $limit = 300;
        $offset = 0;
        $totalFetched = 0;

        do {
            Log::debug('Fetching invoice batch from Odoo', [
                'run_id' => $run->id,
                'limit' => $limit,
                'offset' => $offset,
            ]);

            $records = $odoo->searchRead(
                'primavera.invoice',
                $domain,
                $fields,
                $limit,
                $offset
            );

            $batchCount = count($records);
            $totalFetched += $batchCount;

            Log::debug('Invoice batch fetched', [
                'run_id' => $run->id,
                'batch_count' => $batchCount,
                'total_fetched_so_far' => $totalFetched,
            ]);

            if ($batchCount === 0) {
                Log::debug('No more invoices returned from Odoo');
                break;
            }

            DB::transaction(function () use ($records, $run) {
                foreach ($records as $invoice) {

                    OdooInvoice::updateOrCreate(
                        ['odoo_id' => $invoice['id']],
                        [
                            'partner_odoo_id' => $invoice['partner'][0] ?? null,
                            'partner_name' => $invoice['partner'][1] ?? null,
                            'partner_ref' => $invoice['partner_ref'] ?? null,
                            'doc_ref' => $invoice['doc_ref'] ?? null,
                            'invoice_date' => $invoice['invoice_date'] ?? null,
                            'invoice_date_due' => $invoice['invoice_date_due'] ?? null,
                            'amount_total' => $invoice['amount_total'] ?? null,
                            'balance' => $invoice['balance'] ?? null,
                            'state' => $invoice['state'] ?? null,
                            'currency' => $invoice['currency_id'][1] ?? null,
                            'invoice_code' => $invoice['name'] ?? null,
                            'document_code' => $invoice['document_code'] ?? null,
                            'odoo_create_u' => $invoice['create_uid'][1] ?? null,
                            'odoo_write_date' => $invoice['write_date'] ?? null,
                            'last_synced_at' => Carbon::now('UTC'),
                        ]
                    );
                }

                $run->increment('total_records_synced', count($records));
                $run->update(['last_batch_count' => count($records)]);
            });

            Log::debug('💾 Invoice batch committed to DB', [
                'run_id' => $run->id,
                'batch_count' => $batchCount,
            ]);

            $offset += $limit;

        } while ($batchCount === $limit);

        Log::info('🏁 Invoice sync loop finished', [
            'run_id' => $run->id,
            'total_records_fetched' => $totalFetched,
            'total_records_synced' => $run->total_records_synced,
        ]);
    }
}
