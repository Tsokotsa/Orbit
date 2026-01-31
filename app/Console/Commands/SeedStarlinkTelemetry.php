<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\StarlinkTelemetry;
use App\Models\StarlinkDevice;
use Carbon\Carbon;
use Illuminate\Support\Str;

class SeedStarlinkTelemetry extends Command
{
    protected $signature = 'dev:seed-starlink 
        {--days=1 : Number of days back}
        {--device= : Specific device id}';

    protected $description = 'Generate fake Starlink telemetry for development';

    public function handle(): int
    {
        $days = (int) $this->option('days');
        $deviceId = $this->option('device');

        $device = $deviceId
            ? StarlinkDevice::where('device_id', $deviceId)->first()
            : StarlinkDevice::first();

        if (!$device) {
            $this->error('No Starlink device found');
            return self::FAILURE;
        }

        $this->info("Generating {$days} days of telemetry for {$device->device_id}");

        $start = now('UTC')->subDays($days);
        $now   = now('UTC');

        $rows = [];

        while ($start <= $now) {

            // Simulate real-world fluctuation
            $download = max(0, rand(20, 150) + sin($start->minute / 10) * 20);
            $upload   = max(0, rand(5, 40)   + cos($start->minute / 10) * 5);

            $rows[] = [
                'id' => (string) Str::uuid(),
                'service_line_number' => $device->service_line_number,
                'device_id' => $device->device_id,
                'device_type' => 'UT',
                'observed_at' => $start->copy(),
                'metrics' => [
                    'DownlinkThroughput' => round($download, 2),
                    'UplinkThroughput'   => round($upload, 2),
                ],
                'alerts' => [],
                'raw' => [],
                'created_at' => now('UTC'),
                'updated_at' => now('UTC'),
            ];

            // insert in chunks
            if (count($rows) >= 500) {
                StarlinkTelemetry::insert($rows);
                $rows = [];
            }

            $start->addMinute();
        }

        if (!empty($rows)) {
            StarlinkTelemetry::insert($rows);
        }

        $this->info('✅ Telemetry seeded successfully');

        return self::SUCCESS;
    }
}
