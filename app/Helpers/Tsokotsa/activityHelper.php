<?php

namespace App\Helpers\Tsokotsa;

use Spatie\Activitylog\Models\Activity;
use Jenssegers\Agent\Agent;

class ActivityHelper
{

    /**
     * Log activity with user info, account, device, IP and timestamp
     *
     * @param string $description
     * @param mixed|null $subject
     * @param int|null $accId
     * @return void
     */
    function logActivity(string $description, $accId = null, $subject = null)
    {
        $agent = new Agent();

        activity()
            ->causedBy(auth()->user())
            //->performedOn($subject)
            ->withProperties([
                'acc_id' => $accId ?? auth()->user()->acc_id ?? null,
                'ip' => request()->ip(),
                'user_agent' => request()->userAgent(),
                'device' => $agent->device(),
                'platform' => $agent->platform(),
                'browser' => $agent->browser(),
                'timestamp' => now()->toDateTimeString(),
            ])
            ->log($description);
    }

}


