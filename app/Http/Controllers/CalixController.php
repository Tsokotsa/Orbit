<?php

namespace App\Http\Controllers;

use App\Services\CalixService;
use DB;
use Log;

class CalixController extends Controller
{
    protected CalixService $calix;

    public function __construct(CalixService $calix)
    {
        $this->calix = $calix;
    }

    /**
     * Show GUI variables
     */
    public function index()
    {
        $calix_settings = DB::table(table: "calix_settings")->get();
        $query = $calix_settings[0]->region;
        
        Log::info("$calix_settings");
        $endpoint = "/rest/v1/config/device/gui/{$query}";
        $settings = json_decode($calix_settings[0]->settings, true);

        $offset = $settings['offset']; // 0
        $limit = $settings['limit'];  // 20


        Log::info("Settings for the [CALIX] are ::: Offset $offset and Limit $limit " );

        $variables = $this->calix->exec_query($endpoint, $query, $offset, $limit);

        return view('calix.dashboard')->with(["variables" => $variables]);
    }
}
