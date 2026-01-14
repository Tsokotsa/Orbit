<?php

namespace App\Http\Controllers;

use App\Helpers\Tsokotsa\generalHelpers;
use App\Mail\SendTestMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class EmailController extends Controller
{
    private $campaign_type = "E-mail";


    public function index()
    {
        $user = auth()->user();
        $campaign = DB::table("campaigns")
            ->where('type_id', 1)
            ->where('id', 2)
            ->get();
        Log::info("Rendering view " . __FUNCTION__ . " for user " . json_encode($user));
        return view('email.index', ['user' => $user, 'composed_email' => $campaign]);
    }

    // List Emails
    public function listEmails()
    {
        $user = auth()->user();
        $campaign = DB::table("campaigns")
                    ->where('type_id', 1)
                    ->where('created_by', $user->id)
                    ->get();
        Log::info("Rendering view " . __FUNCTION__ . " for user " . json_encode($user));
        return view("email.list", ['user' => $user,  'campaigns' => $campaign]);
    }

    public function send_test_Email(Request $request)
    {
        $GH = new generalHelpers();
        $campaign_type = $GH->get_campaign_typeID($this->campaign_type);
        $user = auth()->user();

        $data['to']             = $request['compose_to'];
        $data['subject']        = $request['compose_subject'];
        $data['msg']            = $request['test-text'];
        $data['campaign_type']  = $campaign_type;

        Mail::to($data['to'])->queue(new SendTestMail($data));
        $ret = $GH->log_Msgs($data, $user);

        if ($ret) {
            return "OK";
        } else {
            return "Error Occured while sending test message ...";
        }
    }

    public function getSubscribers()
    {

        $GH = new generalHelpers();
        $campaign_id = $GH->get_campaign_typeID($this->campaign_type);
        $subscribers = DB::table('contacts')
            ->orwhereJsonContains('notify_on', "$campaign_id")
            ->get();

        Log::info("Finished getting all subscribers for this campign id " . $campaign_id . " Using Function: " . __FUNCTION__);

        return $subscribers;
    }

    public function scheduleEmail(Request $request)
    {
        $user = auth()->user();
        if ($request->consent !== 'Y') {
            return response()->json(["message" => "You did not agree that all is ok. check settings", "status" => "error", "title" => "Snapppp...", 500]);
        }

        $queued_by      = $user->id;
        $to             = $request->compose_to;
        $cc             = $request->compose_cc;
        $bcc            = $request->compose_bcc;
        $queued_title   = $request['compose_subject'];
        $queued_content = $request['compose-text'];
        $status         = 'Processing';

        $queue = DB::table("email_queue")
            ->insert([
                "queued_from"   => "Web",
                "recipient"     => $to,
                "uid"           => $user->id,
                "cc"            => $cc,
                "bcc"           => $bcc,
                "title"         => $queued_title,
                "content"       => $queued_content,
                "status"        => $status
            ]);
        if ($queue) {
            Log::info("Successfully logged message to be processed on mail queue");
            return response()->json(["message" => "Successfully Logged Queue", 200]);
        } else {
            Log::error("Error Occured inserting message to queue table");
            return response()->json(["message" => "Error Occured Inseting queue", 500]);
        }
    }

    public function setSettings(Request $request)
    {
        $user = Auth()->user();
        $attach_path    = "email-attachment"; // Path to store the attachments
        $campaign_id    = $request['campaign_id'];

        // Set the status depending on aknowledgment
        if ($request["ack"] === "y") {
            $status = "Queued";
        } else {
            $status = "Processing";
        }

        //Store the user into the storage
        Log::info("Storing Attachments into the storage ....");
        if ($request->hasFile('email_attach')) {
            $attach = $request->file('email_attach')->store($attach_path, 'public');
            Log::info("Email Attachment file stored as $attach ");
        } else {
            Log::error("File could not be stored because was not passed ");
            return response()->json(["message" => "Failed to get file from request"], 500);
        }
        // Extract the file name
        $filename = basename($attach);
        $settings = [
            "overide_to"        => $request->all_contacts,
            "send_internaly"    => $request->internaly_copy,
            "send_later"        => $request->later,
            "schedule_date"     => $request->schedule_dt,
            "path"              => $attach_path,
        ];

        Log::info("Filled the settings " . json_encode($settings));

        Log::info("Going to update the mail_queue table now .....");
        $q = DB::table("email_queue")
            ->where('campaign_id', $campaign_id)
            ->update([
                "settings"      => json_encode($settings),
                "attachments"   => $filename,
                "status"        => $status,
            ]);
        if ($q) {
            return response()->json(["message" => "Updated Successfull"], 200);
        } else {
            return response()->json(["message" => "Error occurred during DB update"], 500);
        }
    }
}
