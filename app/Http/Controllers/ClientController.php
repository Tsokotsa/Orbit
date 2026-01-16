<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Log;

class ClientController extends Controller
{

    // Class property
    protected $client_services_table;

    // Constructor to initialize it
    public function __construct()
    {
        $this->client_services_table = "client_service_"; // example, could come from auth() or request
    }

    public function view_cLient(Request $request)
    {
        $client = "";
        $client_id = $request->query('client_id'); // retrieves 6170

        // $client_query = $odoo->execute(
        //     'res.partner',
        //     'search_read',
        //     [
        //         [['id', '=', $client_id]],
        //     ],
        //     [
        //         'fields' => ['id', 'name', 'email', 'phone', 'company_type', 'create_date',],
        //         //'limit' => 5,
        //     ]
        // );
        // $client = $client_query[0];
        //    Log::info("Retrieving Client wih ID:  $client_id");
        return view('clients.view')->with('client_id', $client_id);
    }

    public function get_all_assets()
    {
        $assets = DB::table("client_assets")->get();

        Log::info("Retrieved Many clients from DB $assets");

        return view('clients.tabs.assets', [
            'assets' => $assets
        ]);
    }

    public function list_all_services()
    {
        return view('clients.service-list');
    }

    public function load($tab, Request $request)
    {
        // $client_id = $request->query('client_id');

        // Log::info("Got from Request $client_id");
        // return false;

        switch ($tab) {
            case 'overview':

                return view('clients.tabs.overview')->with('client_id', "1734");

            case 'assets':
                $clientId = $request->query('client_id');
                $assets = DB::table("client_assets")
                    ->where("client_id", $clientId)
                    ->get();

                Log::info("Retrieved Many clients from DB $assets");
                Log::info("This is the cliet ID that was passed on the [ $tab ] TAB $clientId");

                return view('clients.tabs.assets', [
                    'assets' => $assets,
                    'cid' => $clientId
                ]);

            case 'services':

                $clientId = $request->query('client_id');

                Log::info("Retrieving all Services for client $clientId");

                // 1️⃣ Get distinct table_identifiers
                $serviceGroups = DB::table('services')
                    ->select('table_identifier')
                    ->distinct()
                    ->get();

                $clientServices = [];

                foreach ($serviceGroups as $group) {

                    $tableIdentifier = $group->table_identifier;
                    $table = $this->client_services_table . $tableIdentifier;

                    // 2️⃣ Get service IDs for this table_identifier
                    $serviceIds = DB::table('services')
                        ->where('table_identifier', $tableIdentifier)
                        ->pluck('id');

                    // 3️⃣ Count client services in the dynamic table
                    $count = DB::table($table)
                        ->where('client_id', $clientId)
                        ->whereIn('service_id', $serviceIds)
                        ->count();

                    if ($count > 0) {
                        // 4️⃣ Get display data (icon, speed, etc.)
                        $serviceMeta = DB::table('services')
                            ->where('table_identifier', $tableIdentifier)
                            ->first();

                        $clientServices[] = [
                            'service_name' => $tableIdentifier,
                            'icon' => $serviceMeta->icon,
                            'd_speed' => $serviceMeta->d_speed,
                            'count' => $count,
                        ];
                    }

                }

                Log::info("This is the cliet ID that was passed on the [ $tab ] TAB $clientId");
                return view('clients.tabs.services', [
                    'client_id' => $clientId,
                    'client_services' => $clientServices
                ]);


            case 'logs':
                $clientId = $request->query('client_id');
                Log::info("This is the cliet ID that was passed on the [ $tab ] TAB $clientId");
                return view('clients.tabs.logs', [
                    'client_id' => $clientId
                ]);

            default:
                return response('Invalid tab', 404);
        }
    }

    public function store_asset(Request $request)
    {
        // ✅ Insert into client_assets table
        DB::table('client_assets')->insert([
            'client_id' => $request->input('client_id'),
            'asset_id' => $request->input('asset_id'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Asset successfully assigned to client'
        ]);
    }
}