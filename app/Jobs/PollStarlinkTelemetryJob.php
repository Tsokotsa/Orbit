<?php

namespace App\Jobs;

use App\Services\StarlinkService;
use App\Helpers\Tsokotsa\Starlink;
use App\Models\StarlinkTelemetry;
use App\Models\StarlinkDevice;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class PollStarlinkTelemetryJob
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    // Prevent runaway jobs
    public $timeout = 120;
    public $tries   = 3;

    public function handle(StarlinkService $service): void
    {
        Log::debug("Starlink === JOB POLL TELEMETRY STARTED");

        $response = $service->request(
            'post',
            '/telemetry/stream',
            [
                'batchSize' => 1000,
                'maxLingerMs' => 15000,
            ]
        );

        $rows = $service->normalizeValues($response);

        $parsed = Starlink::parseTelemetry([
            'telemetry' => $rows,
            'metadata' => $response['metadata'] ?? [],
        ]);

        foreach ($parsed as $record) {

            $device = StarlinkDevice::where('device_id', $record['device_id'])->first();

            if (!$device) {
                Log::warning('Unmapped telemetry device', [
                    'device_id' => $record['device_id'],
                ]);
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
                    'raw'                  => $record['raw'],
                ]
            );
        }

        Log::debug("Starlink === JOB POLL TELEMETRY FINISHED", [
            'records' => count($parsed),
        ]);
    }

    /**
     * Convert Starlink "values + columnNames" into associative rows
     */
}
