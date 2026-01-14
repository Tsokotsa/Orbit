<?php

namespace App\Console\Commands;

use App\Helpers\Tsokotsa\emailHelper;
use App\Mail\OutageNotification;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class SendEmails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send-email-cmd';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command to Send Scheduled emails';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $EH = new emailHelper();
        Log::info('Starting ========   Send Email DAEMON  =========');
        $emails_to_queue = DB::table("email_queue")
            // ->where('id', 8)
            ->where('status', 'Queued')
            ->get();

        //return false;

        if ($emails_to_queue->isNotEmpty()) {
            foreach ($emails_to_queue as $email_to_queue) {

                $to_data = json_decode($email_to_queue->recipient);
                $settings = json_decode($email_to_queue->settings);

                $path = $settings->path;

                // Check if is to send later or now
                $instruction = $EH->checkScheduledEmail($settings);
                if ($instruction === "now") {
                    if ($settings->overide_to === "on"){
                        Log::info("Send to All was enabled so it will overide email selections");
                        $to_data = $EH->getAllEmailContacts();
                    }
                    foreach ($to_data as $to) {
                        Log::info("Send to All was NOT enabled emails will be set to the selected TO list");
                        //  Mail::to($to->email)->send(new OutageNotification($email_to_queue, $to, $path));
                        Log::info("Those are the settings " . $path);
                        Log::debug("This is the file to be attached: $email_to_queue->attachments");

                        Log::info("Found EMAIL to Queue and it will now Process for Name: " . $to->email . " .....");
                        Log::debug("Email tags with title: [ $email_to_queue->title ] and following settings: $email_to_queue->settings");

                        // Setting Mail queue as processed 
                        DB::table('email_queue')
                            ->where("campaign_id", $email_to_queue->campaign_id)
                            ->update(["status" => "Processed"]);

                        // Setting campaign as processed
                        DB::table('campaigns')
                            ->where("id", $email_to_queue->campaign_id)
                            ->update(["status" => "Processed"]);
                    }
                } else {
                    Log::info("Instruction is $instruction");
                }
            }
        } else {
            Log::warning("No Email FOUND to ==== QUEUE =====");
        }
    }
}
