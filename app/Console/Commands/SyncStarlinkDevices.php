<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\StarlinkService;
use App\Models\StarlinkDevice;
use Illuminate\Support\Facades\Log;

class SyncStarlinkDevices extends Command
{
    protected $signature = 'starlink:sync-devices';
    protected $description = 'Sync Starlink service lines to device mapping';

    public function handle(StarlinkService $service): int
    {
        $this->info('Syncing Starlink devices...');
        Log::info("Starlink ===     SYNC DEVICES STARTED    ====");

        try {
            $response = $service->allUserTerminals();

            $results = $response['content']['results'] ?? [];

            $count = 0;

            foreach ($results as $terminal) {
                if (empty($terminal['serviceLineNumber'])) {
                    continue;
                }

                StarlinkDevice::updateOrCreate(
                    [
                        'service_line_number' => $terminal['serviceLineNumber'],
                        'device_id' => $terminal['userTerminalId'],
                    ],
                    [
                        'device_type' => 'user_terminal',
                        'kit_serial' => $terminal['kitSerialNumber'] ?? null,
                        'dish_serial' => $terminal['dishSerialNumber'] ?? null,
                    ]
                );

                $count++;
            }

            $this->info("Synced {$count} terminals");
            Log::info('Starlink device sync completed', ['count' => $count]);

            return self::SUCCESS;

        } catch (\Throwable $e) {
            Log::error('Starlink device sync failed', [
                'error' => $e->getMessage(),
            ]);

            $this->error('Sync failed: ' . $e->getMessage());
            return self::FAILURE;
        }
    }

}
