<?php

namespace App\Http\Controllers;

use DB;
use Yajra\DataTables\DataTables;
use Illuminate\Http\Request;
use Log;
use Str;

class AssetsController extends Controller
{
    public function view()
    {
        $user = auth()->user();
        $vendors = DB::table('vendor')
            ->select(
                'vendor.id',
                'vendor.name',
                'vendor.description',
                'vendor.logo_path',

                // total models
                DB::raw('(
            SELECT COUNT(*)
            FROM vendor_models
            WHERE vendor_models.v_id = vendor.id
        ) as total_models'),

                // total assets
                DB::raw('(
            SELECT COUNT(*)
            FROM assets
            JOIN vendor_models ON vendor_models.id = assets.model
            WHERE vendor_models.v_id = vendor.id
        ) as vendor_assets'),

                // total assets overall
                DB::raw('(
            SELECT COUNT(*)
            FROM assets
        ) as total_assets'),

                // all model names concatenated
                DB::raw('(
            SELECT GROUP_CONCAT(name SEPARATOR " | ")
            FROM vendor_models
            WHERE vendor_models.v_id = vendor.id
        ) as model_names')
            )
            ->get();



        Log::info("This is our vendor : $vendors");

        return view("assets.index")->with(['vendors' => $vendors, 'user' => $user]);
    }

    public function get_all_ajax(Request $request)
    {
        $user = auth()->user();

        try {
            $assets = DB::table('assets')
                ->select(
                    'assets.*',
                    'vendor.name as vendor_name',    // adjust field names
                    'vendor.logo_path as logo_path',
                    'vendor_models.name as model_name',
                    'stock_group.name as group_name',
                    'mediums.name as medium_name'
                )
                ->leftJoin('vendor', 'assets.vendor_id', '=', 'vendor.id')
                ->leftJoin('vendor_models', 'assets.model', '=', 'vendor_models.id')
                ->leftJoin('stock_group', 'assets.group_id', '=', 'stock_group.id')
                ->leftJoin('mediums', 'assets.media_type', '=', 'mediums.id')
                // ->where('serial', 'like', '%' . $q . '%')
                ->limit(10)
                ->get(['id', 'serial', 'vendor_name', 'logo_path', 'description', 'model_name', 'model', 'medium_name', 'status']);

            return DataTables::of($assets)->make(true);
        } catch (\Exception $e) {
            return response()->json([
                'draw' => intval($request->input('draw')),
                'recordsTotal' => 0,
                'recordsFiltered' => 0,
                'data' => [],
                'error' => $e->getMessage(),
            ]);
        }
    }

    public function get_all_mediums_ajax()
    {
        $mediums = DB::table('mediums')
            ->select('id', 'name')
            ->orderBy('name')
            ->get();

        return $mediums;
    }

    public function get_all_vendors_ajax()
    {
        $vendors = DB::table('vendor')
            ->select('id', 'name', 'logo_path')
            ->orderBy('name')
            ->get();

        return $vendors;
    }

    public function add_vendor(Request $request)
    {
        Log::info("Adding NEW Vendor using Function: " . __FUNCTION__);

        try {

            DB::beginTransaction();

            // ✅ Validate input
            $request->validate([
                'vendor_name' => 'required|string|max:255',
                'vendor_desc' => 'nullable|string|max:160',
                'avatar' => 'nullable|image|mimes:png,jpg,jpeg|max:2048'
            ]);

            $name = $request->vendor_name;
            $description = $request->vendor_desc;

            // ✅ Default logo path (must exist inside storage/app/public/vendors)
            $avatarPath = "assets/media/vendors/paratus.png";

            if ($request->hasFile('avatar')) {

                $file = $request->file('avatar');

                $filename = \Illuminate\Support\Str::slug($name) . '.png';

                $destination = public_path('assets/media/vendors');

                // Ensure folder exists
                if (!file_exists($destination)) {
                    mkdir($destination, 0755, true);
                }

                $file->move($destination, $filename);

                $avatarPath = "assets/media/vendors/" . $filename;
            }

            // ✅ Insert into database
            DB::table('vendor')->insert([
                'name' => $name,
                'description' => $description,
                'logo_path' => $avatarPath,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            DB::commit();

            Log::info("Vendor successfully added", [
                'name' => $name,
                'logo_path' => $avatarPath,
                'created_by' => auth()->id()
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Vendor added successfully'
            ]);

        } catch (\Exception $e) {

            DB::rollBack();

            Log::error("Vendor creation failed", [
                'error' => $e->getMessage()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Failed to add vendor. Please try again.'
            ], 500);
        }
    }


    public function add_model(Request $request)
    {
        $user = auth()->user();
        // Get raw Tagify JSON string
        $modelsJson = $request->vendor_model; // e.g., '[{"value":"MG3455"},{"value":"MG6789"}]'

        // Decode JSON to array
        $modelsArray = json_decode($modelsJson, true); // array of arrays

        // Prepare array for DB insert
        $insertData = [];
        foreach ($modelsArray as $item) {
            if (!empty($item['value'])) {
                $insertData[] = [
                    'v_id' => $request->vendor_id,
                    'name' => $item['value'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
        }

        // Insert all at once
        if (!empty($insertData)) {
            DB::table('vendor_models')->insert($insertData);
        }

        return response()->json([
            'success' => true,
            'message' => 'Vendor models added successfully'
        ]);
    }

    public function get_all_vendor_and_medium()
    {
        $vendors = $this->get_all_vendors_ajax();
        $mediums = $this->get_all_mediums_ajax();

        return response()->json([
            'vendors' => $vendors,
            'mediums' => $mediums,
        ]);
    }

    public function store(Request $request)
    {
        DB::table('assets')->insert([
            'vendor_id' => $request->vendor_id,
            'media_type' => $request->medium_id,
            'serial' => $request->asset_serial,
            'asset_name' => $request->asset_description,
            'description' => $request->asset_description,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Asset added successfully'
        ]);
    }

}
