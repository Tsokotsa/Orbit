<?php

namespace App\Helpers\Tsokotsa;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Spatie\Activitylog\Models\Activity;


if (! function_exists('logActivity')) {
    /**
     * Log activity with user_id and acc_id.
     *
     * @param string $description
     * @param mixed $subject
     * @param int|null $accId
     * @return void
     */
    function logActivity(string $description, $subject = null, $accId = null)
    {
        activity()
            ->causedBy(auth()->user())
            ->performedOn($subject)
            ->withProperties([
                'acc_id' => $accId ?? auth()->user()->acc_id ?? null,
            ])
            ->log($description);
    }
}
