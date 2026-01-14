<?php

namespace App\Helpers\Tsokotsa;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class telegramHelper
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public function countTotalTelegram()
    {
        Log::info("Getting total Telegram registered on the trends table from ".__FUNCTION__ ." Function");
        $msg_total = DB::table("telegram_queue")->count();
        
        return $msg_total;
    }

    public function getTotalfromTrend()
    {
        $total_trend = DB::table('dashboard_trends')->latest('telegram')->first();
        Log::info("Total Records from trend: " .json_encode($total_trend->telegram) ." got from Function " .__FUNCTION__ );

        return $total_trend->telegram;
    }
}
