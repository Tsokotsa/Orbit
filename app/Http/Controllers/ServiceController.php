<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Log;

class ServiceController extends Controller
{
    public function get_all_services(Request $request)
    {
        return view("clients.services.index");
    }

    public function get_service_fiber(Request $request)
    {
        return view("clients.services.fiber-tab");
    }

    public function get_service_wireless(Request $request)
    {
        return view("clients.services.wireless-tab");
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
