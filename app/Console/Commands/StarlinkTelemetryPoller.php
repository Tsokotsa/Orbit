<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use App\Services\Starlink\TelemetryProcessor;

class StarlinkTelemetryPoller extends Command
{
    protected $signature = 'starlink:poll {accountId?}';
    protected $description = 'Poll Starlink Telemetry Stream (Enterprise Mode)';

    public function handle(TelemetryProcessor $processor)
    {
        $accountId = $this->argument('accountId');

        Log::channel('starlink')->info('Starlink telemetry poller started', [
            'account_id' => $accountId,
        ]);

        try {
            $processor->pollAndProcess($accountId);
        } catch (\Throwable $e) {
            Log::channel('starlink')->critical(
                'Telemetry Poll failed',
                ['message' => $e->getMessage()]
            );
        }


    }
}
