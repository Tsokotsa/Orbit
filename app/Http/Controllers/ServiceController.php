<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Log;
use function Laravel\Prompts\select;

class ServiceController extends Controller
{
    protected $client_services_table;

    // Constructor to initialize it
    public function __construct()
    {
        $this->client_services_table = "client_service_"; // example, could come from auth() or request
    }

    public function get_service_by_id($table, $client_id)
    {
        $table = $this->client_services_table.$table;
        /* $allowedTables = ['service_table1', 'service_table2', 'service_table3']; Tsokotsa Future filter tables

        if (!in_array($table, $allowedTables)) {
            throw new \Exception("Invalid table name");
        }
            */

        Log::info("Querying Services on table [ $table ]");

        return DB::table($table)
            ->join('services', "$table.service_id", '=', 'services.id')
            ->where("$table.client_id", $client_id)
            ->select(
                "$table.*", "services.*"         // All columns from client-specific table

            )->get();

    }


    public function get_all_services(Request $request)
    {
        return view("clients.services.index");
    }

    public function get_service_fiber(Request $request)
    {
        $table = "fiber";
        $clientID = $request->client_id;

        $services = $this->get_service_by_id($table, $clientID);

        Log::info("Found Services for client $clientID  ====  $services");

        return view("clients.services.fiber-tab")->with(["services_$table" => $services]);
    }

    public function get_service_wireless(Request $request)
    {
        $table = "wireless";
        $clientID = $request->client_id;

        $services = $this->get_service_by_id($table, $clientID);

        Log::info("Found Services for client $clientID  ====  $services");

        return view("clients.services.wireless-tab")->with(['services' => $services]);
    }

    public function get_service_satt(Request $request)
    {
        $table = "satt";
        $clientID = $request->client_id;

        $services = $this->get_service_by_id($table, $clientID);

        Log::info("Found Services for client $clientID  ====  $services");

        return view("clients.services.satt-tab")->with(['services' => $services]);
    }

    public function get_ajax(Request $request)
    {
        $q = $request->q;

        // return DB::table('assets')
        //     ->where('serial', 'like', '%' . $q . '%')
        //     ->limit(10)
        //     ->get(['id', 'serial', 'asset_name', 'description']);


        $assets = DB::table('assets')
            ->select(
                'assets.*',
                'vendor.name as vendor_name',    // adjust field names
                'vendor_models.name as model_name',
                'stock_group.name as group_name',
                'mediums.name as medium_name'
            )
            ->leftJoin('vendor', 'assets.vendor_id', '=', 'vendor.id')
            ->leftJoin('vendor_models', 'assets.model', '=', 'vendor_models.id')
            ->leftJoin('stock_group', 'assets.group_id', '=', 'stock_group.id')
            ->leftJoin('mediums', 'assets.media_type', '=', 'mediums.id')
            ->where('serial', 'like', '%' . $q . '%')
            ->limit(10)
            ->get(['id', 'serial', 'asset_name', 'description', 'model_name', 'model']);

        Log::info("$assets");

        return $assets;
    }


}
