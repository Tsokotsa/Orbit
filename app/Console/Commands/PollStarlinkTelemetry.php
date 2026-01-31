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
    protected $signature = 'starlink:poll';
    protected $description = 'Poll Starlink telemetry stream';

    public function handle(): int
    {
        \App\Jobs\PollStarlinkTelemetryJob::dispatch();
        $this->info('Starlink poll job dispatched');

        return self::SUCCESS;
    }


}
