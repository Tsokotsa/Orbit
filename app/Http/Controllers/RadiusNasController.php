<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class RadiusNasController extends Controller
{
    protected $radius;

    public function __construct()
    {
        $this->radius = DB::connection('radius');
    }
    public function nasView()
    {
        $nas = DB::connection('radius')->table('nas')->get();

        return view('radius.partials.nas-list', compact('nas'));
    }

    /*
    |--------------------------------------------------------------------------
    | ADD NAS
    |--------------------------------------------------------------------------
    */
    public function store(Request $request)
    {
        $request->validate([
            'nasname' => 'required',
            'shortname' => 'required',
            'secret' => 'required',
            'type' => 'required',
            'description' => 'nullable',
        ]);

        $this->radius->table('nas')->insert([
            'nasname' => $request->nasname,
            'shortname' => $request->shortname,
            'secret' => $request->secret,
            'type' => $request->type,
            'description' => $request->description,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'NAS created successfully'
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | UPDATE NAS
    |--------------------------------------------------------------------------
    */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nasname' => 'required',
            'shortname' => 'required',
            'secret' => 'required',
            'type' => 'required',
        ]);

        $this->radius->table('nas')
            ->where('id', $id)
            ->update([
                'nasname' => $request->nasname,
                'shortname' => $request->shortname,
                'secret' => $request->secret,
                'type' => $request->type,
                'description' => $request->description,
            ]);

        return response()->json([
            'success' => true,
            'message' => 'NAS updated successfully'
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | DELETE NAS
    |--------------------------------------------------------------------------
    */
    public function destroy($id)
    {
        $this->radius->table('nas')
            ->where('id', $id)
            ->delete();

        return response()->json([
            'success' => true,
            'message' => 'NAS deleted successfully'
        ]);
    }
}

