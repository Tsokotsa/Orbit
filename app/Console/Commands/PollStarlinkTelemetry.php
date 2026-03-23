<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\StarlinkService;
use App\Helpers\Tsokotsa\Starlink;
use App\Models\StarlinkTelemetry;
use App\Models\StarlinkDevice;
use Log;

class PollStarlinkTelemetry extends Command
{
    protected $signature = 'starlink:poll {jobId}';
    protected $description = 'Poll Starlink telemetry stream';

    public function handle(): int
    {
        $jobId = $this->argument('jobId');

        \App\Jobs\PollStarlinkTelemetryJob::dispatch($jobId);

        $this->info("Starlink poll job dispatched for jobId {$jobId}");

        return self::SUCCESS;
    }
}
