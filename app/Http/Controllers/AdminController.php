<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\PermissionRegistrar;
use Illuminate\Support\Facades\Log;



class AdminController extends Controller
{
    public function resetPermissionCache()
    {
        Log::info('Permission cache reset triggered', [
            'user' => auth()->user()?->id
        ]);

        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        return response()->json([
            'status' => 'success',
            'message' => 'Permission cache reset successfully'
        ]);
    }
}
