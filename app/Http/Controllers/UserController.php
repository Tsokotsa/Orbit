<?php

namespace App\Http\Controllers;

use App\Helpers\Tsokotsa\generalHelpers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\Facades\DataTables;
use Spatie\Permission\Models\Permission;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user();
        $users = User::query();
        $roles = DB::table('roles')->get();
        $data = DataTables::of($users)->addIndexColumn()->toJson();

        return view('user.index')->with(['user' => $user, 'roles' => $roles]);
    }

    public function getUsers(Request $request)
    {
        try {
            $users = User::query();

            return DataTables::of($users)->make(true);
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

    /**
     * Show the form for creating a new resource.
     */
    public function add_user(Request $request)
    {

        $uid = auth()->user();
        $user = new User;
        $GH = new generalHelpers();

        $request->validate([
            'user-avatar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        //Store the user into the storage
        Log::info("Storing avatar into the storage ....");
        $avatarPath = $request->file('user-avatar')->store($this->get_user_avatar_path(), 'public');

        // Extract the file name
        $filename = basename($avatarPath);

        // Extract the directory path without the filename
        $directoryPath = dirname($avatarPath);

        // Assigning default password to user 
        Log::info("Assigning default password to user");

        $password = $GH->User_Password();
        $file = [
            'file_path' => "storage/$directoryPath",
            'file_name' => $filename
        ];

        $user->name = $request->name;
        $user->surname = $request->surname;
        $user->password = $password;
        $user->email = $request->email;
        $user->tel1 = $request->phone;
        $user->avatar = json_encode($file);
        $user->telegram_id = $request->telegram;
        $user->save();

        // User created and saved into the DB 
        Log::info("User " . json_encode($user) . " Created");

        Log::info('Get the latest ID of the inserted User ....');
        $lastInsertedId = $user->id;

        // Find the role by ID
        $role = Role::findOrFail($request->user_role);

        // Assign the role to the user
        $user->assignRole($role);
        Log::info("Assigning $role ID to User with [ID ::: $lastInsertedId]");

        return response()->json(['message' => 'User successfull created'], 200);
    }

    // public function get_user_avatar_path()
    // {
    //     $avatar_path = DB::table('app_paths')->where('model_name', 'user')->first();
    //     Log::info("Getting the path to store the avatar. Path [ $avatar_path->storage_path ] found ....." . __FUNCTION__);

    //     return $avatar_path->storage_path;
    // }

    public function get_user_avatar_path()
    {
        $avatar_path = DB::table('app_paths')
            ->where('model_name', 'user')
            ->first();

        if (!$avatar_path || !$avatar_path->storage_path) {
            Log::warning("Avatar path not found, using default: user/avatar");
            return 'user/avatar';
        }

        Log::info("Avatar path: {$avatar_path->storage_path}");

        return trim($avatar_path->storage_path, '/');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function edit_user($uid)
    {
        $user = Auth::user();

        $user_edit = User::find($uid);
        Log::info("Finding user with ID $uid");

        return view('user.edit', ['user_edit' => $user_edit, 'user' => $user]);
    }

    public function updateEmail(Request $request)
    {
        $uid = $request['uid'];
        $email = $request['profile_email'];
        $user_to_update = User::find($uid);

        if ($user_to_update->email === $email) {
            return response()->json(['message' => 'Provided email is the same as the old. Nothing to update...'], 500);
        } else {
            $result = DB::table('users')->where('id', $uid)
                ->update(['email' => $email]);
        }
        if ($result) {
            Log::warning("Email for User updated to $email");
            return response()->json(['message' => 'Email successfull update'], 200);
        } else {
            return response()->json(['message' => 'Unable to update email'], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function updatePasswd(Request $request)
    {

        $uid = $request['uid'];
        $password = $request['new_password'];
        $GF = new generalHelpers;
        $user_model = new User();
        $validate = $user_model->validatePassword($request);

        //Change Password                                                                                                                                                                   
        if ($validate !== 'AG') {
            return $validate;
        } else {
            $user = auth()->user();
            $result = DB::table('users')->where('id', $uid)
                ->update(['password' => bcrypt($password)]);
            if ($result) {
                Log::warning("User $user have been updated with new password");
                return response()->json(['message' => 'Password successfull update'], 200);
            } else {
                Log::warning("User $user tried update password but encounterd an error ...");
                return response()->json(['message' => 'Error occured while updating password'], 500);
            }
        }
    }

    public function getUserRoles(User $user)
    {
        $roles = Role::select('id', 'name')->get();

        return response()->json([
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'roles' => $user->roles->pluck('name'),
            ],
            'roles' => $roles
        ]);
    }

    public function updateRole(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'roles' => 'required|array'
        ]);

        $user = User::findOrFail($request->user_id);

        $user->syncRoles($request->roles);

        return redirect()
            ->back()
            ->with('success', 'User role updated successfully.');
    }

    public function updateDetails(Request $request)
    {
        $user = User::findOrFail($request->uid);

        // Keep current avatar by default
        $file = $user->avatar;

        // Check if a new avatar was uploaded
        if ($request->hasFile('user-avatar')) {

            // Delete old avatar if it exists
            if (!empty($user->avatar['file_name'])) {
                $oldFilePath = $this->get_user_avatar_path() . '/' . $user->avatar['file_name'];

                if (Storage::disk('public')->exists($oldFilePath)) {
                    Storage::disk('public')->delete($oldFilePath);
                    Log::info("Old avatar deleted: {$oldFilePath}");
                }
            }

            // Store new avatar
            $avatarPath = $request->file('user-avatar')->store(
                $this->get_user_avatar_path(),
                'public'
            );

            $file = [
                'file_path' => 'storage/' . dirname($avatarPath),
                'file_name' => basename($avatarPath),
            ];

            Log::info("New avatar uploaded", $file);
        }

        // Update user fields
        $user->name = $request->name;
        $user->surname = $request->surname;
        $user->email = $request->email;
        $user->tel1 = $request->phone;
        $user->telegram_id = $request->telegram;

        // Save avatar as ARRAY (Laravel cast handles JSON automatically)
        $user->avatar = $file;

        if ($user->save()) {
            Log::info("User {$user->id} updated successfully");

            return response()->json([
                'message' => 'User details updated successfully'
            ], 200);
        }

        Log::error("Failed updating user {$user->id}");

        return response()->json([
            'message' => 'Error occurred while updating user'
        ], 500);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function view_profile()
    {
        $user = Auth::user();
        $uid = $user->id;

        $user_edit = User::find($uid);
        Log::info("Finding user with ID $uid");

        return view('user.edit', ['user_edit' => $user_edit, 'user' => $user]);
    }

    public function permissions(User $user)
    {
        $permissions = Permission::query()
            ->orderBy('name')
            ->get()
            ->map(function ($permission) use ($user) {

                $parts = explode('.', $permission->name);

                return [

                    'id' => $permission->id,

                    'name' => $permission->name,

                    'model' => $parts[0] ?? '-',

                    'action' => $parts[1] ?? '-',

                    'assigned' => $user->hasPermissionTo($permission->name),
                ];
            });

        return response()->json([
            'data' => $permissions
        ]);
    }

    public function assignPermission(Request $request, User $user)
    {
        $request->validate([
            'permission_id' => ['required', 'exists:permissions,id']
        ]);

        $permission = Permission::findOrFail($request->permission_id);

        /*
        |--------------------------------------------------------------------------
        | Prevent duplicate assignment
        |--------------------------------------------------------------------------
        */
        if (!$user->hasPermissionTo($permission->name)) {

            $user->givePermissionTo($permission->name);
        }

        return response()->json([
            'success' => true,
            'message' => 'Permission assigned successfully'
        ]);
    }

    public function removePermission(Request $request, User $user)
    {
        $request->validate([
            'permission_id' => ['required', 'exists:permissions,id']
        ]);

        $permission = Permission::findOrFail($request->permission_id);

        /*
        |--------------------------------------------------------------------------
        | Remove only if assigned
        |--------------------------------------------------------------------------
        */
        if ($user->hasPermissionTo($permission->name)) {

            $user->revokePermissionTo($permission->name);
        }

        return response()->json([
            'success' => true,
            'message' => 'Permission removed successfully'
        ]);
    }
}
