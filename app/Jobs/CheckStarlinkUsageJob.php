<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\StarlinkDataUsageNotification;
use App\Models\StarlinkRouterUsage;
use DB;

class CheckStarlinkUsageJob implements ShouldQueue
{
    use Dispatchable, Queueable;

    public function handle()
    {
        $services = StarlinkRouterUsage::select('service_id')
            ->distinct()
            ->get();

        foreach ($services as $service) {

            $usagePercent = $this->calculateUsage($service->service_id);

            $notifications = StarlinkDataUsageNotification::where('service_id', $service->service_id)
                ->where('active', true)
                ->get();

            foreach ($notifications as $notification) {

                if ($usagePercent < $notification->threshold_percent) {
                    continue;
                }

                // 🔥 prevent duplicates
                $alreadySent = DB::table('starlink_notifications_logs')
                    ->where('notification_id', $notification->id)
                    ->where('threshold_percent', $notification->threshold_percent)
                    ->exists();

                if ($alreadySent) {
                    continue;
                }

                dispatch(new SendStarlinkNotificationJob(
                    $notification,
                    $usagePercent
                ));
            }
        }
    }

    private function calculateUsage($serviceId): int
    {
        // 👉 YOU plug your logic here (GB used vs quota)
        return rand(40, 100); // placeholder
    }
}
