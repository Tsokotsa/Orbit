<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\StarlinkDataUsageNotification;
use DB;
use Log;

class SendStarlinkNotificationJob implements ShouldQueue
{
    use Dispatchable, Queueable;

    public function __construct(public StarlinkDataUsageNotification $notification, public int $usagePercent)
    {

    }

    public function handle()
    {
        $data = [
            'client_id' => $this->notification->client_id,
            'service_id' => $this->notification->service_id,
            'usage_percent' => $this->usagePercent,
            'timestamp' => now(),
        ];

        foreach ($this->notification->channels as $channel) {

            try {

                // 👉 Plug your SMS / Email / WhatsApp here
                Log::info("Sending {$channel} notification", $data);

                DB::table('starlink_notifications_logs')->insert([
                    'notification_id' => $this->notification->id,
                    'client_id' => $this->notification->client_id,
                    'service_id' => $this->notification->service_id,
                    'threshold_percent' => $this->notification->threshold_percent,
                    'processed_data' => json_encode($data),
                    'status' => 'sent',
                    'channel' => $channel,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);

            } catch (\Throwable $e) {

                DB::table('starlink_notifications_logs')->insert([
                    'notification_id' => $this->notification->id,
                    'client_id' => $this->notification->client_id,
                    'service_id' => $this->notification->service_id,
                    'threshold_percent' => $this->notification->threshold_percent,
                    'processed_data' => json_encode($data),
                    'status' => 'error',
                    'channel' => $channel,
                    'notes' => $e->getMessage(),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
