<?php

namespace App\Helpers\Tsokotsa;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class emailHelper
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public function countTotalEmail()
    {
        Log::info("Getting total Email registered on the trends table from " . __FUNCTION__ . " Function");
        $msg_total = DB::table("email_queue")->count();

        return $msg_total;
    }

    public function getTotalfromTrend()
    {
        $total_trend = DB::table('dashboard_trends')->latest('sms')->first();
        Log::info("Total Records from trend: " . json_encode($total_trend->emails) . " got from Function " . __FUNCTION__);

        return $total_trend->emails;
    }

    public function getAllEmailContacts()
    {
        $emails = DB::table("contacts")->get();
        return $emails;
    }

    public function checkScheduledEmail($settings)
    {
        $ret = "";
        $now = Carbon::parse(now())->setSeconds(0)->micro(0);
        $futureDate = Carbon::parse($settings->schedule_date)->setSeconds(0)->micro(0);

        Log::info("Checking if the email should be sent now or later " . __FUNCTION__);

        if ($settings->send_later === "on") {
            $timeUntil = $futureDate->diffForHumans($now);
            if ($futureDate->eq($now)) {
                Log::info("This should occure now as scheduled $futureDate  IS EQUAL TO " . $now);
                $ret = "now";
                return $ret;
            } elseif ($futureDate->gt($now)) {
                Log::info("The date $futureDate  in the database is in the FUTURE it will occur in $timeUntil");
                $ret = "later";
                return "Email queud found but to be sent $timeUntil";
            } elseif ($futureDate->lt($now)) {
                Log::info("The date $futureDate  in the database is in the PAST compared to " . $now . " it occured $timeUntil");
                $ret = "past";
                return "All emails are processed nothing to be queued";
            }
        }
    }
}
