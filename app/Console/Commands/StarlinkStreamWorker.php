<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\StarlinkService;
use App\Helpers\Tsokotsa\Starlink;
use App\Models\StarlinkTelemetry;
use App\Models\StarlinkDevice;
use Illuminate\Support\Arr;
use Carbon\Carbon;
use Log;

class StarlinkStreamWorker extends Command
{
    protected $signature = 'starlink:stream 
        {--once}
        {--sleep=1}';

    protected $description = 'Continuously stream Starlink telemetry until caught up';

    public function handle(StarlinkService $service): int
    {
        $sleep = (int) $this->option('sleep');
        $runOnce = $this->option('once');

        $this->info('🚀 Starlink telemetry worker started');

        while (true) {
            try {
                $response = $service->request(
                    'post',
                    '/telemetry/stream',
                    [
                        'batchSize'   => 2000,   // big batch = faster catch-up
                        'maxLingerMs' => 15000,  // let Starlink wait
                    ]
                );

                $rows = $this->normalizeValues($response);

                $parsed = Starlink::parseTelemetry([
                    'telemetry' => $rows,
                    'metadata'  => $response['metadata'] ?? [],
                ]);

                $latestObservedAt = null;

                foreach ($parsed as $record) {
                    $device = StarlinkDevice::where(
                        'device_id',
                        $record['device_id']
                    )->first();

                    if (!$device) {
                        continue;
                    }

                    StarlinkTelemetry::updateOrCreate(
                        [
                            'device_id'   => $record['device_id'],
                            'observed_at' => $record['observed_at'],
                        ],
                        [
                            'device_type'         => $record['device_type'],
                            'service_line_number' => $device->service_line_number,
                            'metrics'             => $record['metrics'],
                            'alerts'              => $record['alerts'],
                            'raw'                 => $record['raw'],
                        ]
                    );

                    $latestObservedAt = $record['observed_at'];
                }

                $count = count($parsed);

                $this->info("📦 Stored {$count} records");

                if ($latestObservedAt) {
                    $lagSeconds = now('UTC')->diffInSeconds($latestObservedAt);

                    $this->info(
                        "⏱ Lag: {$lagSeconds}s | Latest observed: {$latestObservedAt->toDateTimeString()}"
                    );

                    Log::info('Starlink stream lag', [
                        'lag_seconds' => $lagSeconds,
                        'observed_at' => $latestObservedAt,
                    ]);
                }

            } catch (\Throwable $e) {
                Log::error('Starlink stream error', [
                    'error' => $e->getMessage(),
                ]);

                $this->error($e->getMessage());

                // Backoff on error
                sleep(5);
            }

            if ($runOnce) {
                break;
            }

            sleep($sleep);
        }

        return self::SUCCESS;
    }

    /**
     * Normalize Starlink telemetry values
     */
    protected function normalizeValues(array $response): array
    {
        $rows = [];

        $values  = $response['data']['values'] ?? [];
        $columns = $response['data']['columnNamesByDeviceType'] ?? [];

        foreach ($values as $row) {
            $deviceType = $row[0] ?? null;

            if (!$deviceType || !isset($columns[$deviceType])) {
                continue;
            }

            $assoc = array_combine($columns[$deviceType], $row);

            if (isset($assoc['UtcTimestampNs'])) {
                $assoc['observed_at'] = Carbon::createFromTimestampMs(
                    intdiv($assoc['UtcTimestampNs'], 1_000_000),
                    'UTC'
                );
            }

            if (isset($assoc['DeviceId'])) {
                $assoc['DeviceId'] = preg_replace(
                    '/^(ut|r|i)/',
                    '',
                    $assoc['DeviceId']
                );
            }

            $rows[] = $assoc;
        }

        return $rows;
    }
}
