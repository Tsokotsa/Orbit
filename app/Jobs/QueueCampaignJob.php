<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use PhpParser\Node\Stmt\Switch_;

class QueueCampaignJob //implements ShouldQueue
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
        Log::info("starting ===     JOB   ===== to queue Campaigns");
        $campaigns = DB::table("campaigns")
            ->where('status', 'Queued')
            ->get();
        if ($campaigns->isNotEmpty()) {
            foreach ($campaigns as $campaign) {

                switch ($campaign->type_id) {
                    case '1':
                        Log::info("Queueing for Email Campaing");
                        $res = DB::table("email_queue")->insert([
                            "queued_from"   => 'Local Job',
                            "recipient"     => $campaign->recipients,
                            "title"         => $campaign->name,
                            "content"       => "",
                            "status"        => 'Processing',
                            "queue_type"    => $campaign->type_id
                        ]);
                        if ($res) {
                            Log::info("Update the campaigns table. Mensagem with ID [ $campaign->id ] will now be set as Processing");
                            $upd = DB::table("campaigns")->where('id', $campaign->id)->update(['status' => 'Idle']);
                            Log::debug("Campaign updated " . json_encode($upd));
                            break;
                        }
                    case '2':
                        Log::info("Queueing for SMS Campaing");
                        $res = DB::table("msgs_queue")->insert([
                            "queued_from"   => 'Local Job',
                            "recipient"     => $campaign->recipients,
                            "title"         => $campaign->name,
                            "content"       => "",
                            "status"        => 'Processing',
                            "queue_type"    => $campaign->type_id
                        ]);
                        if ($res) {
                            Log::info("Update the campaigns table. Mensagem with ID [ $campaign->id ] will now be set as Processing");
                            $upd = DB::table("campaigns")->where('id', $campaign->id)->update(['status' => 'Idle']);
                            Log::debug("Campaign updated " . json_encode($upd));
                            break;
                        }

                    case '3':
                        Log::info("Queueing for Telegram Campaing");
                        $res = DB::table("telegram_queue")->insert([
                            "queued_from"   => 'Local Job',
                            "recipient"     => $campaign->recipients,
                            "title"         => $campaign->name,
                            "content"       => "",
                            "status"        => 'Processing',
                            "queue_type"    => $campaign->type_id
                        ]);
                        if ($res) {
                            Log::info("Update the campaigns table. Mensagem with ID [ $campaign->id ] will now be set as Processing");
                            $upd = DB::table("campaigns")->where('id', $campaign->id)->update(['status' => 'Idle']);
                            Log::debug("Campaign updated " . json_encode($upd));
                            break;
                        }

                    default:
                        Log::warning("ERROR bad company type found ....." . json_encode($campaigns));
                        break;
                }
            }
        } else {
            Log::warning("No Available Campaigns To queue or process trying again shortly .....");
        }
    }
}
