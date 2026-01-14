<?php

namespace App\Helpers\Tsokotsa;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class generalHelpers
{
    public static function get_campaign_typeID($campaign_name)
    {
        $query = DB::table('campaigns_type')->where('type', $campaign_name)->select('id')->pluck('id');
        
        Log::info("Getting Campaign id function: " .__FUNCTION__);
        return $query[0];

    }

    public function log_Msgs($message, $user)
    {
        DB::table('sent_messages_logs')->insert([
            'type_id'       => $message['campaign_type'],
            'uid'           => $user->id,
            'sent_to'       => $message['to'],
            'subj'          => $message['subject'],
            'details'       => $message['msg'],
            'created_at'    => Carbon::now()
        ]);

        Log::info("Logging Message " .json_encode($message) ."and " .json_encode($user) ." function: " .__FUNCTION__);

        return "Message Logged";

    }

    // Get All High Sites 

    public function get_all_high_sites()
    {
        $sites = DB::table('high_sites')->get();

        Log::info("Getting All High sites function: " .__FUNCTION__);
        return $sites;

    }

    // Get all Campaings that are Active

    public function get_all_Active_Campaigns()
    {
        $campaigns = DB::table('campaigns_type')->get();

        Log::info("Getting all active campaigns function: " .__FUNCTION__);
        return $campaigns;
    }

    function generateDefaultPassword()
    {

        Log::info("Starting to generate a random password with Function: " .__FUNCTION__);
        // Define the character pool for the password
        $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()';
        $passwordLength = 12; // Set the desired password length
        $password = '';

        // Randomly select characters from the pool
        for ($i = 0; $i < $passwordLength; $i++) {
            $password .= $characters[rand(0, strlen($characters) - 1)];
        }

        Log::info("Password Generated " .__FUNCTION__);
        return $password;
    }

    public function User_Password()
    {
        Log::info("Generating default password for new USER " .__FUNCTION__);
        return "User.2024";
    }
}
