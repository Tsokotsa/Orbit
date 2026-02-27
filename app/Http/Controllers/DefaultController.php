<?php

namespace App\Http\Controllers;

use App\Helpers\Tsokotsa\emailHelper;
use App\Helpers\Tsokotsa\smsHelper;
use App\Helpers\Tsokotsa\telegramHelper;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class DefaultController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function login()
    {
        return view('sign-in');
    }

    public function land()
    {
        $total_msgs = DB::table("dashboard_trends")->orderBy('id', 'desc')->first();
        $user = auth()->user();
        return view(
            'land',
            [
                'user' => $user,
                //     'total_sms'         => $total_msgs->sms,
                //     'total_emails'      => $total_msgs->emails,
                //    'total_telegram'    => $total_msgs->telegram,
            ]
        );
    }

    public function create_Campaign(Request $request)
    {
        $user = auth()->user();

        switch ($request->all_contacts) {
            case 'on':
                $contacts = "All";
                break;

            default:
                $contacts = "Only Subscribed";
                break;
        }
        ;

        switch ($request->preview_msg) {
            case 'on':
                $preview = "y";
                break;

            default:
                $preview = "n";
                break;
        }
        ;

        $name = $request->project_name;
        $type_id = $request->type;
        $recipients = $contacts;
        //$preview = $preview;
        $send_at = $request->scheduled_dt;
        $repeat = $request->repeat_interval;
        $doc = $request->campaign_doc;

        $campaign = DB::table('campaigns')->insert([
            'name' => $name,
            'type_id' => $type_id,
            'recipients' => $contacts,
            'preview_to_creator' => $preview,
            'send_at' => $send_at,
            'repeat_interval' => $repeat,
            'created_by' => $user->id,
            'created_at' => Carbon::now(),
        ]);

        return $campaign;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function cancelCampaign(Request $request)
    {
        $user = Auth()->user();

        $campaign_id = $request->campaign_id;

        Log::info("Updating Campaign [ ID :: $campaign_id ]");
        $campaign = DB::table("campaigns")
            ->where("id", $campaign_id)
            ->update([
                "status" => "canceled",
                "details" => "campaign canceled by user ID [ $user->id ]",
            ]);

        if ($campaign) {
            Log::info("Cancelling campaign [ ID: $campaign_id ] by User " . json_encode($user));
            return response()->json(["message" => "Campaign Canceled"], 200);
        } else {
            return response()->json(["message" => "Error occurred thrying to cancell campaign"], 500);
        }

        $campaign = DB::table("campaigns")->where("id", $campaign_id)->get();

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
