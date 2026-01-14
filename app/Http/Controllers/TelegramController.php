<?php

namespace App\Http\Controllers;

use App\Helpers\Tsokotsa\generalHelpers;
use App\Jobs\SendTestTelegramJob;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Telegram\Bot\Api;

class TelegramController extends Controller
{

    private $campaign_type = "Telegram";

    
    public function index()
    {
        return "ok";
    }

    // Teste Telegram API
    public function send_test(Request $request)
    {
        $GH = new generalHelpers();
        $campaign_type = $GH->get_campaign_typeID($this->campaign_type);
        $user = auth()->user();
        $token = config('telegram.bots.Alert-dev.token');

        $data['to']             = $request['telegram-id'];
        $data['subject']        = "Telegram";
        $data['msg']            = $request['telegram-text'];
        $data['campaign_type']  = $campaign_type;

        SendTestTelegramJob::dispatch($data, $token);
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
            ->orwhereJsonContains('notify_on',"$campaign_id")
            ->get();

        Log::info("Finished getting all subscribers for this campign id " .$campaign_id ." Using Function: " .__FUNCTION__);

            return $subscribers;
    }
}
