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
use App\Models\OdooPartner;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class SyncOdooPartnersJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $timeout = 600;
    public $tries = 3;

    public function handle(OdooService $odoo)
    {
        $startTime = now();
        $model = 'res.partner';

        Log::info('Odoo partner sync requested', ['model' => $model]);

        /**
         * STEP 1 — Acquire lock
         */
        DB::beginTransaction();
        $lock = OdooSyncLock::lockForUpdate()->firstOrCreate(['model' => $model]);

        if ($lock->status === 'running') {
            DB::rollBack();
            Log::warning('Odoo partner sync skipped — already running', [
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

        Log::info('Odoo partner sync lock acquired', [
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

        Log::info('Odoo partner sync started', ['run_id' => $run->id]);

        /**
         * STEP 3 — Run sync
         */
        try {
            $this->sync($odoo, $run, $lock);

            $duration = $startTime->diffInSeconds(now());

            $run->update([
                'status' => 'success',
                'finished_at' => now(),
            ]);

            $lock->update([
                'status' => 'idle',
                'last_sync_at' => Carbon::now('UTC'),
            ]);

            Log::info('Odoo partner sync completed', [
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

            Log::error('Odoo partner sync failed', [
                'run_id' => $run->id,
                'exception' => $e,
            ]);

            throw $e;
        }
    }

    /**
     * Sync logic — increment happens here, per batch
     */
    protected function sync(OdooService $odoo, OdooSyncRun $run, OdooSyncLock $lock)
    {
        // We fetch clients updated since the last successful run
        $lastSync = $lock->last_sync_at;

        // Domain ensures we only fetch records changed since last sync
        $domain = $lastSync ? [['write_date', '>', $lastSync]] : [];

        Log::info('Odoo partner sync domain', [
            'run_id' => $run->id,
            'last_sync_at' => $lastSync,
            'domain' => $domain,
        ]);

        $fields = [
            'id',
            'parent_id',
            'is_company',
            'active',
            'customer_rank',
            'supplier_rank',
            'name',
            'email',
            'phone',
            'mobile',
            'company_type',
            'vat',
            'street',
            'street2',
            'city',
            'zip',
            'state_id',
            'country_id',
            'create_date',
            'write_date',
            'child_ids',
            'invoice_ids',
            'prim_invoices_ids',
            'purchase_line_ids',
            'sale_order_ids',
            'subscription_ids',
            'contract_ids',
            'opportunity_ids',
            'sale_order_count',
            'opportunity_count',
            'user_id',
            'create_uid',
            'write_uid',
            'synchronized_m3ms'
        ];

        $limit = 500;
        $offset = 0;
        $total = 0;

        do {
            $records = $odoo->searchRead('res.partner', $domain, $fields, $limit, $offset);
            $batchCount = count($records);
            $total += $batchCount;

            Log::debug('Odoo partner batch fetched', [
                'run_id' => $run->id,
                'offset' => $offset,
                'count' => $batchCount,
            ]);

            // Batch update
            DB::transaction(function () use ($records, $run) {
                foreach ($records as $partner) {

                    // Fetch local partner
                    $local = OdooPartner::where('odoo_id', $partner['id'])->first();

                    // Only update if new or Odoo write_date is newer
                    if (!$local || strtotime($partner['write_date']) > strtotime($local->odoo_write_date)) {

                        OdooPartner::updateOrCreate(
                            ['odoo_id' => $partner['id']],
                            [
                                'parent_odoo_id' => $partner['parent_id'][0] ?? null,
                                'is_company' => (bool) ($partner['is_company'] ?? false),
                                'active' => (bool) ($partner['active'] ?? false),
                                'customer_rank' => $partner['customer_rank'] ?? 0,
                                'supplier_rank' => $partner['supplier_rank'] ?? 0,
                                'name' => $partner['name'] ?? '',
                                'email' => $partner['email'] ?? null,
                                'phone' => $partner['phone'] ?? null,
                                'mobile' => $partner['mobile'] ?? null,
                                'vat' => $partner['vat'] ?? null,
                                'street' => $partner['street'] ?? null,
                                'street2' => $partner['street2'] ?? null,
                                'city' => $partner['city'] ?? null,
                                'zip' => $partner['zip'] ?? null,
                                'state' => $partner['state_id'][1] ?? null,
                                'country' => $partner['country_id'][1] ?? null,
                                'company_type' => $partner['company_type'] ?? null,
                                'child_ids' => $partner['child_ids'] ?? null,
                                'invoice_ids' => $partner['invoice_ids'] ?? null,
                                'prim_invoices_ids' => $partner['prim_invoices_ids'] ?? null,
                                'purchase_line_ids' => $partner['purchase_line_ids'] ?? null,
                                'sale_order_ids' => $partner['sale_order_ids'] ?? null,
                                'subscription_ids' => $partner['subscription_ids'] ?? null,
                                'contract_ids' => $partner['contract_ids'] ?? null,
                                'opportunity_ids' => $partner['opportunity_ids'] ?? null,
                                'sale_order_count' => $partner['sale_order_count'] ?? null,
                                'opportunity_count' => $partner['opportunity_count'] ?? null,
                                'odoo_create_date' => $partner['create_date'] ?? null,
                                'odoo_write_date' => $partner['write_date'] ?? null,
                                'user_id' => $partner['user_id'] ?? null,
                                'create_uid' => $partner['create_uid'] ?? null,
                                'write_uid' => $partner['write_uid'] ?? null,
                                'synchronized_m3ms' => $partner['synchronized_m3ms'] ?? null,
                                'last_synced_at' => Carbon::now('UTC'),
                            ]
                        );
                    }
                }
            });

            // Increment audit row only if batch has changes
            if ($batchCount > 0) {
                $run->increment('total_records_synced', $batchCount);
                $run->update(['last_batch_count' => $batchCount]);
            }

            Log::debug('Odoo partner sync progress', [
                'run_id' => $run->id,
                'total_synced' => $run->total_records_synced,
            ]);

            $offset += $limit;

        } while ($batchCount === $limit);

        Log::info('Odoo partner sync finished', [
            'run_id' => $run->id,
            'total_records' => $total,
        ]);
    }

}
