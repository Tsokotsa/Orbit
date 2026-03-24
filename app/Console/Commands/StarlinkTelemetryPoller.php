<?php

namespace App\Console\Commands;

use App\Jobs\PollStarlinkTelemetryJob;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use App\Services\Starlink\TelemetryProcessor;
use App\Models\StarlinkAccount;

class StarlinkTelemetryPoller extends Command
{
    protected $signature = 'starlink:poll {jobId?}';
    protected $description = 'Poll Starlink Telemetry Stream (Enterprise Mode)';

    // public function handle(TelemetryProcessor $processor)
    // {
    //     $jobId = $this->argument('jobId');

    //     try {

    //         if (app()->environment('local2')) {
    //             Log::warning('Telemetry polling disabled in LOCAL');
    //             return Command::SUCCESS;
    //         }

    //         $accounts = StarlinkAccount::where('active', 'y')->get();

    //         if ($accounts->isEmpty()) {
    //             Log::warning('No active Starlink accounts found');
    //             return Command::FAILURE;
    //         }

    //         Log::info('Starlink telemetry poller started', [
    //             'accounts_count' => $accounts->count(),
    //             'jobId' => $jobId
    //         ]);

    //         $totalRecords = 0;

    //         foreach ($accounts as $account) {

    //             Log::info('Polling account', [
    //                 'account_name' => $account->account_name,
    //             ]);

    //             $count = $processor->pollAndProcess($account->id);

    //             $totalRecords += $count;
    //         }

    //         // ✅ Update job tracker
    //         if ($jobId) {
    //             DB::table('starlink_telemetry_refresh')
    //                 ->where('id', $jobId)
    //                 ->update([
    //                     'status' => 'done',
    //                     'records_updated' => $totalRecords,
    //                     'notes' => "Updated {$totalRecords} telemetry records",
    //                     'updated_at' => now(),
    //                 ]);
    //         }

    //         return Command::SUCCESS;

    //     } catch (\Throwable $e) {

    //         Log::critical('Starlink telemetry poll failed', [
    //             'message' => $e->getMessage(),
    //         ]);

    //         if ($jobId) {
    //             DB::table('starlink_telemetry_refresh')
    //                 ->where('id', $jobId)
    //                 ->update([
    //                     'status' => 'failed',
    //                     'notes' => $e->getMessage(),
    //                     'updated_at' => now(),
    //                 ]);
    //         }

    //         return Command::FAILURE;
    //     }
    // }

    public function handle(TelemetryProcessor $processor)
    {
        $jobId = $this->argument('jobId');

        try {

            if (app()->environment('local2')) {
                Log::warning('Telemetry polling disabled in LOCAL');
                return Command::SUCCESS;
            }

            // Prevent duplicate runs
            $running = DB::table('starlink_telemetry_refresh')
                ->where('status', 'running')
                ->exists();

            if ($running) {
                Log::warning('Telemetry poll skipped - job already running');
                return Command::SUCCESS;
            }

            // If scheduler triggered it → create job
            if (!$jobId) {
                $jobId = DB::table('starlink_telemetry_refresh')->insertGetId([
                    'status' => 'running',
                    'executed_by' => 'system | scheduler',
                    'records_updated' => 0,
                    'notes' => 'Started by scheduler',
                    'executed_at' => now(),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);

                Log::info("Scheduler created telemetry job {$jobId}");
            }

            $accounts = StarlinkAccount::where('active', 'y')->get();

            if ($accounts->isEmpty()) {
                Log::warning('No active Starlink accounts found');
                return Command::FAILURE;
            }

            Log::info('Starlink telemetry poller started', [
                'accounts_count' => $accounts->count(),
                'jobId' => $jobId
            ]);

            foreach ($accounts as $account) {
                PollStarlinkTelemetryJob::dispatch($jobId, $account->id);
            }

            return Command::SUCCESS;

        } catch (\Throwable $e) {

            Log::critical('Starlink telemetry poll failed', [
                'message' => $e->getMessage(),
            ]);

            if ($jobId) {
                DB::table('starlink_telemetry_refresh')
                    ->where('id', $jobId)
                    ->update([
                        'status' => 'failed',
                        'notes' => $e->getMessage(),
                        'updated_at' => now(),
                    ]);
            }

            return Command::FAILURE;
        }
    }
}