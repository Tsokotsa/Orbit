<?php

namespace App\Jobs;

use App\Helpers\Tsokotsa\emailHelper;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Helpers\Tsokotsa\smsHelper;
use App\Helpers\Tsokotsa\telegramHelper;

class CountMsgsJob
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        // Count Telegram
        $TH = new telegramHelper();
        Log::info("Start Count and Logging Total TELEGRAM in DB");
        $telegram = $TH->countTotalTelegram();

        Log::debug("Total Records found ============= TELEGRAM TOTAL: $telegram   ===============");

        // Count Emails
        $EH = new emailHelper();
        Log::info("Start Count and Logging Total EMAILS in DB");
        $emails = $EH->countTotalEmail();

        Log::debug("Total Records found ============= EMAILS TOTAL: $emails   ===============");

        // Count SMS
        $SH = new smsHelper();
        Log::info("Start Count and Logging Total SMS in DB");
        $msgs = $SH->countTotalSms();

        Log::debug("Total Records found ============= SMS TOTAL: $msgs   ===============");
        $ret = DB::table("dashboard_trends")->insert([
                                                    'sms' => $msgs, 
                                                    'telegram' => $telegram, 
                                                    'emails' => $emails 
                                                ]);

        if($ret){
            Log::info("Updated table ------- Dashboard Trends " .json_encode($ret));
        } else {
            Log::error("Error Occured updating  Dashboard Trends !!!!!!!!");
        }
    }
}
