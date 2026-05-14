<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Str;
use Illuminate\Support\Facades\DB;

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

    public function view_role(Role $role)
    {
        $user = Auth::user();

        // Load permissions relationship
        $role->load('permissions');

        $permissions = $role->permissions->map(function ($perm) {

            $parts = explode('.', $perm->name);

            return [
                'id' => $perm->id,
                'name' => $perm->name,
                'action' => $parts[1] ?? null,
                'model' => $parts[0] ?? null,
                'guard_name' => $perm->guard_name,
                'created_at' => $perm->created_at,
            ];
        });

        return view('roles-and-permissions.view-role', [
            'user' => $user,
            'role' => $role,
            'permissions' => $permissions,
        ]);
    }

    public function unlinkPermission(Request $request)
    {
        $role = Role::findOrFail($request->role_id);

        $role->permissions()->detach($request->permission_id);

        return response()->json([
            'success' => true
        ]);
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

    public function add_permission(Request $request)
    {
        // Validate input
        // $data = $request->validate([
        //     'permission_name' => 'required|string|max:255|unique:permissions,name',
        //     'permission_description' => 'nullable|string|max:255',
        //     'permission_status' => 'nullable|boolean', // optional
        // ]);
        $permission_name = $request['permission_name'];
        $permission_desc = $request['permission_description'];

        // Create permission
        $permission = Permission::create([
            'name' => $permission_name,
            'guard_name' => 'web',
            'description' => $permission_desc
        ]);

        // Clear Spatie cache
        app(\Spatie\Permission\PermissionRegistrar::class)
            ->forgetCachedPermissions();

        // Response
        return response()->json([
            'success' => true,
            'message' => 'Permission created successfully',
            'permission' => $permission
        ]);
    }

    public function list_perms()
    {
        $user = Auth::user();

        $permissions = Permission::query()
            ->select([
                'id',
                'name',
                'description',
                'guard_name',
                'created_at'
            ])
            ->latest()
            ->get()
            ->map(function ($permission) {

                $parts = explode('.', $permission->name);

                return [
                    'id' => $permission->id,

                    'name' => $permission->name,

                    'description' => $permission->description
                        ?? 'No description',

                    'model' => isset($parts[0])
                        ? Str::headline($parts[0])
                        : 'General',

                    'action' => isset($parts[1])
                        ? Str::headline($parts[1])
                        : 'N/A',

                    'guard_name' => $permission->guard_name,

                    'created_at' => $permission->created_at,
                ];
            });

        return view(
            'roles-and-permissions.view-permissions',
            ['permissions' => $permissions, 'user' => $user]
        );
    }

    public function availablePermissions(Role $role)
    {
        $assignedIds = $role->permissions()->pluck('id');
        // $assignedIds = $role->permissions->pluck('id');

        $permissions = Permission::whereNotIn('id', $assignedIds)->get()
            ->map(function ($perm) {
                $parts = explode('.', $perm->name);

                return [
                    'id' => $perm->id,
                    'name' => $perm->name,
                    'model' => $parts[0] ?? '',
                    'action' => $parts[1] ?? '',
                ];
            });

        // dd($permissions);

        //return response()->json($permissions);
        return response()->json([
            'data' => $permissions
        ]);
    }

    public function assignPermissions(Request $request)
    {
        $role = Role::findOrFail($request->role_id);

        $role->permissions()->attach($request->permissions);

        return response()->json([
            'success' => true,
            'message' => 'Permissions assigned successfully'
        ]);
    }
    public function update(Request $request)
    {

        $role_id = $request['edit_role_id'];
        $role_name = $request['edit_role_name'];
        $role_desc = $request['edit_role_description'];

        $role = Role::findOrFail($role_id);

        // update name
        $role->name = $role_name;

        // update description ONLY if provided
        if ($role_desc !== null) {
            $role->description = $role_desc;
        }

        $role->save();

        // clear Spatie cache
        app(\Spatie\Permission\PermissionRegistrar::class)
            ->forgetCachedPermissions();

        return response()->json([
            'message' => 'Role updated successfully'
        ]);
    }

    public function perm_update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
        ]);

        try {
            DB::beginTransaction();

            $permission = Permission::findById($id);

            if (!$permission) {
                return response()->json([
                    'message' => 'Permission not found'
                ], 404);
            }

            // Prevent duplicate permission names (important in Spatie)
            $exists = Permission::where('name', $request->name)
                ->where('guard_name', $permission->guard_name)
                ->where('id', '!=', $id)
                ->exists();

            if ($exists) {
                return response()->json([
                    'message' => 'Permission name already exists'
                ], 422);
            }

            // Update core fields
            $permission->name = $request->name;

            // If you store description in DB (custom column)
            $permission->description = $request->description;

            $permission->save();

            DB::commit();

            return response()->json([
                'message' => 'Permission updated successfully',
                'permission' => $permission
            ]);

        } catch (\Exception $e) {

            DB::rollBack();

            return response()->json([
                'message' => 'Error updating permission',
                'error' => $e->getMessage()
            ], 500);
        }
    }

}
