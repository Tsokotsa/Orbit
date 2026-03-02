<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use App\Services\Starlink\TelemetryProcessor;
use App\Models\StarlinkAccount;

class StarlinkTelemetryPoller extends Command
{
    protected $signature = 'starlink:poll {accountId?}';
    protected $description = 'Poll Starlink Telemetry Stream (Enterprise Mode)';

    // public function handle(TelemetryProcessor $processor)
    // {
    //     $accountId = $this->argument('accountId');

    //     Log::channel('starlink')->info('Starlink telemetry poller started', [
    //         'account_id' => $accountId,
    //     ]);

    //     try {
    //         $processor->pollAndProcess($accountId);
    //     } catch (\Throwable $e) {
    //         Log::channel('starlink')->critical(
    //             'Telemetry Poll failed',
    //             ['message' => $e->getMessage()]
    //         );
    //     }


    // }

    public function handle(TelemetryProcessor $processor)
    {
        if (app()->environment('local')) {
            Log::warning('This Action will be aborted — running in LOCAL environment.');
            return;

            $accounts = StarlinkAccount::where('active', 'y')->get();

            if ($accounts->isEmpty()) {
                Log::channel('starlink')->warning('No active Starlink accounts found');
                return Command::FAILURE;
            }

            Log::channel('starlink')->info('Starlink telemetry poller started', [
                'accounts_count' => $accounts->count(),
            ]);

            foreach ($accounts as $account) {
                try {
                    Log::channel('starlink')->info('Polling account', [
                        'account_name' => $account->account_name,
                    ]);

                    $processor->pollAndProcess($account->id);

                } catch (\Throwable $e) {
                    Log::channel('starlink')->critical('Telemetry poll failed', [
                        'account_name' => $account->account_name,
                        'message' => $e->getMessage(),
                    ]);
                }
            }

            return Command::SUCCESS;
        }
    }


}
