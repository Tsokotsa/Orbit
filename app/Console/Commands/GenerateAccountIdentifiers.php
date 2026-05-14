<?php

namespace App\Console\Commands;

use App\Models\OdooPartner;
use App\Services\SimoPaymentService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class GenerateAccountIdentifiers extends Command
{
    /**
     * Artisan command
     */
    protected $signature = 'odoo-partners:generate-identifiers';

    /**
     * Command description
     */
    protected $description = 'Generate enterprise-grade payment references for Odoo partners';

    /**
     * Maximum allowed reference seed
     * because reference portion is limited to 9 digits
     */
    private const MAX_REFERENCE_SEED = 999999999;

    /**
     * Execute command
     */
    public function handle(): int
    {
        $start = now();

        Log::channel('daily')->info('Payment reference generation job started', [
            'command' => self::class,
            'started_at' => $start->toDateTimeString(),
        ]);

        $processed = 0;
        $skipped = 0;
        $errors = 0;

        /**
         * Process accounts safely in chunks
         */
        OdooPartner::query()
            ->where(function ($query) {
                $query->whereNull('acc_reference')
                    ->orWhere('acc_reference', '')
                    ->orWhereRaw('TRIM(acc_reference) = ?', ['']);
            })

            // ->where(function ($query) {
            //     $query->whereNull('acc_reference')
            //         ->orWhere('acc_reference', '');
            // })

            ->orderBy('id')

            ->chunkById(500, function ($accounts) use (&$processed, &$skipped, &$errors) {

                foreach ($accounts as $account) {

                    try {

                        DB::transaction(function () use ($account, &$processed, &$skipped) {

                            /**
                             * Lock row to prevent race conditions
                             */
                            $fresh = OdooPartner::query()
                                ->lockForUpdate()
                                ->find($account->id);

                            /**
                             * Record removed during processing
                             */
                            if (!$fresh) {

                                $skipped++;

                                Log::warning('Partner missing during processing', [
                                    'partner_id' => $account->id,
                                ]);

                                return;
                            }

                            /**
                             * Already processed by another worker
                             */
                            if (!empty($fresh->acc_reference)) {

                                $skipped++;

                                Log::info('Partner already has reference', [
                                    'partner_id' => $fresh->id,
                                    'reference' => $fresh->acc_reference,
                                ]);

                                return;
                            }

                            /**
                             * Enterprise-safe reference seed
                             *
                             * NEVER use external IDs directly
                             * because they may exceed limits
                             */
                            $referenceSeed = $fresh->odoo_id;

                            /**
                             * Ensure seed fits 9 digits
                             */
                            if (
                                !is_numeric($referenceSeed)
                                || (int) $referenceSeed < 0
                                || $referenceSeed > self::MAX_REFERENCE_SEED
                            ) {

                                $skipped++;

                                Log::critical('Reference seed invalid', [
                                    'partner_id' => $fresh->id,
                                    'reference_seed' => $referenceSeed,
                                ]);

                                return;
                            }

                            /**
                             * Generate payment reference
                             */
                            $reference = SimoPaymentService::generate(
                                $referenceSeed
                            );

                            /**
                             * Self-validation
                             */
                            if (
                                !SimoPaymentService::validate($reference)
                            ) {

                                throw new \RuntimeException(
                                    'Generated reference failed MOD97 validation.'
                                );
                            }

                            /**
                             * Collision protection
                             */
                            $exists = OdooPartner::query()
                                ->where('acc_reference', $reference)
                                ->exists();

                            if ($exists) {

                                throw new \RuntimeException(
                                    'Reference collision detected.'
                                );
                            }

                            /**
                             * Save reference
                             */
                            $fresh->acc_reference = $reference;

                            $fresh->save();

                            $processed++;

                            /**
                             * Audit log
                             */
                            Log::channel('daily')->info(
                                'Payment reference generated',
                                [
                                    'partner_id' => $fresh->id,
                                    'reference_seed' => $referenceSeed,
                                    'reference' => $reference,
                                    'generated_at' => now()->toDateTimeString(),
                                ]
                            );
                        });

                    } catch (\Throwable $e) {

                        $errors++;

                        Log::channel('daily')->error(
                            'Payment reference generation failed',
                            [
                                'partner_id' => $account->id ?? null,
                                'message' => $e->getMessage(),
                                'trace' => $e->getTraceAsString(),
                            ]
                        );
                    }
                }
            });

        $duration = $start->diffInSeconds(now());

        /**
         * Final audit log
         */
        Log::channel('daily')->info(
            'Payment reference generation job finished',
            [
                'processed' => $processed,
                'skipped' => $skipped,
                'errors' => $errors,
                'duration_seconds' => $duration,
                'finished_at' => now()->toDateTimeString(),
            ]
        );

        /**
         * Console summary
         */
        $this->info(
            "Processed: {$processed} | " .
            "Skipped: {$skipped} | " .
            "Errors: {$errors} | " .
            "Duration: {$duration}s"
        );

        return self::SUCCESS;
    }
}