<?php

namespace App\Helpers\Tsokotsa;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class smsHelper
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public function countTotalSms()
    {
        Log::info("Getting total SMS registered on the trends table from ".__FUNCTION__ ." Function");
        $msg_total = DB::table("msgs_queue")->count();
        
        return $msg_total;
    }

    public function getTotalfromTrend()
    {
        $total_trend = DB::table('dashboard_trends')->latest('sms')->first();
        Log::info("Total Records from trend: " .json_encode($total_trend->sms) ." got from Function " .__FUNCTION__ );

        return $total_trend->sms;
    }
}
