<?php

namespace App\Services\Starlink;

use App\Models\StarlinkRouterUsage;
use App\Services\StarlinkService; // ✅ corrected namespace
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class TelemetryProcessor2
{
    public function __construct(

        protected StarlinkService $starlinkService
    ) {
    }

    public function pollAndProcess(?int $accountId = null): void
    {
        $payload = [
            'batchSize' => 1000,
            'maxLingerMs' => 15000,
        ];

        $response = $this->starlinkService->request(
            'post',
            '/telemetry/stream',
            $payload,
            $accountId,
            silent: true
        );

        if (empty($response['data']['values'])) {
            Log::channel('starlink')->info('Telemetry: No data returned');
            return;
        }

        $this->process($response);
    }

    protected function process(array $payload): void
    {
        $columns = $payload['data']['columnNamesByDeviceType']['r'] ?? [];
        $rows = $payload['data']['values'] ?? [];

        if (empty($columns)) {
            Log::channel('starlink')->warning('Telemetry: Router columns missing');
            return;
        }

        $indexMap = [
            'device' => array_search('DeviceId', $columns),
            'timestamp' => array_search('UtcTimestampNs', $columns),
            'wan_tx' => array_search('WanTxBytes', $columns),
            'wan_rx' => array_search('WanRxBytes', $columns),
        ];

        foreach ($rows as $row) {

            if ($row[0] !== 'r') {
                continue;
            }

            DB::transaction(function () use ($row, $indexMap) {

                $deviceId = $row[$indexMap['device']] ?? null;
                $timestampNs = $row[$indexMap['timestamp']] ?? null;

                if (!$deviceId || !$timestampNs) {
                    return;
                }

                $timestamp = Carbon::createFromTimestamp(
                    $timestampNs / 1_000_000_000
                );

                $wanTx = $row[$indexMap['wan_tx']] ?? 0;
                $wanRx = $row[$indexMap['wan_rx']] ?? 0;

                $previous = StarlinkRouterUsage::where('device_id', $deviceId)
                    ->orderByDesc('recorded_at')
                    ->lockForUpdate()
                    ->first();

                $deltaTx = $previous ? max(0, $wanTx - $previous->wan_tx_bytes) : 0;
                $deltaRx = $previous ? max(0, $wanRx - $previous->wan_rx_bytes) : 0;

                // Convert to Mbps (15-second interval)
                $txMbps = ($deltaTx * 8) / (15 * 1_000_000);
                $rxMbps = ($deltaRx * 8) / (15 * 1_000_000);

                StarlinkRouterUsage::updateOrCreate(
                    [
                        'device_id' => $deviceId,
                        'recorded_at' => $timestamp,
                    ],
                    [
                        'wan_tx_bytes' => $wanTx,
                        'wan_rx_bytes' => $wanRx,
                        'delta_tx_bytes' => $deltaTx,
                        'delta_rx_bytes' => $deltaRx,
                        'tx_mbps' => $txMbps,
                        'rx_mbps' => $rxMbps,
                    ]
                );
            });
        }

        Log::channel('starlink')->info('Telemetry batch processed', [
            'rows_count' => count($rows),
        ]);
    }
}
