<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;

class RolesPermissionController extends Controller
{
    public function list_roles_perms()
    {
        $user = Auth::user();

        $roles = Role::with('permissions')
            ->withCount('users')
            ->get();

        return view('roles-and-permissions.index', ['user' => $user, 'roles' => $roles]);
    }

    public function add_role(Request $request)
    {
        $role_name = $request->role_name;
        $role_description = $request->role_description;
        if ($request->has('role_status')) {
            $role_status = "Active";
        } else {
            $role_status = "Disabled";
        }

        $role = Role::create([
            'name' => $role_name,
            'description' => $role_description,
            'status' => $role_status
        ]);

        if ($role) {
            return response()->json(['message' => 'Role successfully created!'], 200);
        } else {
            return response()->json(['message' => 'Error occurred while creating role!'], 500);
        }
    }
}
