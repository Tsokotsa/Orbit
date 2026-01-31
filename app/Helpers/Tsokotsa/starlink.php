<?php

namespace App\Helpers\Tsokotsa;

use Illuminate\Support\Arr;
use Carbon\Carbon;

class Starlink
{
    /**
     * Decode Starlink alert codes to human-readable strings
     */
    public static function decodeAlerts(
        array $alertCodes,
        array $metadata,
        string $deviceType = 'u'
    ): array {
        $map = $metadata['enums']['AlertsByDeviceType'][$deviceType] ?? [];

        return collect($alertCodes)
            ->map(fn($code) => $map[$code] ?? "unknown_{$code}")
            ->values()
            ->all();
    }

    /**
     * Parse raw Starlink telemetry response
     */
    public static function parseTelemetry(array $response): array
    {
        $records = [];

        foreach ($response['telemetry'] ?? [] as $row) {
            $deviceType = $row['DeviceType'] ?? 'u';

            $records[] = [
                'device_type' => $deviceType,
                'device_id' => $row['DeviceId'] ?? null,

                'observed_at' => isset($row['UtcTimestampNs'])
                    ? Carbon::createFromTimestampMs(
                        intdiv($row['UtcTimestampNs'], 1_000_000)
                    )
                    : now(),

                'metrics' => Arr::except($row, [
                    'DeviceType',
                    'UtcTimestampNs',
                    'DeviceId',
                    'ActiveAlerts',
                ]),

                'alerts' => self::decodeAlerts(
                    $row['ActiveAlerts'] ?? [],
                    $response['metadata'] ?? [],
                    $deviceType
                ),

                'raw' => $row,
            ];
        }

        return $records;
    }
}
