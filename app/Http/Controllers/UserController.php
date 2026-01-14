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
            'file_path' =>  "storage/$directoryPath",
            'file_name' =>  $filename
        ];

        $user->name         = $request->name;
        $user->surname      = $request->surname;
        $user->password     = $password;
        $user->email        = $request->email;
        $user->tel1         = $request->phone;
        $user->avatar       = json_encode($file);
        $user->telegram_id  = $request->telegram;
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

    public function get_user_avatar_path()
    {
        $avatar_path = DB::table('app_paths')->where('model_name', 'user')->first();
        Log::info("Getting the path to store the avatar. Path [ $avatar_path->storage_path ] found ....." . __FUNCTION__);

        return $avatar_path->storage_path;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function edit_user($uid)
    {
        $user_edit = User::find($uid);
        Log::info("Finding user with ID $uid");

        return view('user.edit', ['user' => $user_edit]);
    }

    public function updateEmail(Request $request)
    {
        $uid    = $request['uid'];
        $email  = $request['profile_email'];
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

        $uid    = $request['uid'];
        $password  = $request['new_password'];
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

    /**
     * Show the form for editing the specified resource.
     */
    public function updateDetails(Request $request)
    {
        $uid    = $request['uid'];
        $user   = User::findOrFail($uid);

        //$user->fill($request->all());

        // Need to replace old Avatar instead of adding new one
        $avatar = json_decode($user->avatar);
        if ($avatar) {

            $avatar_path = $avatar->file_path;
            $avatar_file = $avatar->file_name;
        
            $file_full_path = $avatar_path . '/' . $avatar_file;

            $absolutePath = Storage::disk('public')->path("user/avatar/$avatar_file");

            Log::notice("The file is $avatar_file and  The avatar full path is [ $file_full_path ] and absolute path $absolutePath");

            if (Storage::disk('public')->exists("user/avatar/$avatar_file")) {
                Log::warning("Avatar for user $user found and deleted $file_full_path ");
                //unlink($absolutePath);
                Storage::disk('public')->delete("user/avatar/$avatar_file");
                $avatarPath = $request->file('user-avatar')->store($this->get_user_avatar_path(), 'public');
                // Extract the dir name
                $directoryPath = dirname($avatarPath);

                // Extract the file name
                $filename = basename($avatarPath);

                $file = [
                    'file_path' =>  "storage/$directoryPath",
                    'file_name' =>  $filename,
                ];
            } else {
                Log::warning("File $avatar_file not FOUND ...... ");
                Log::info("New avatar will be creatted for user $user");
                $avatarPath = $request->file('user-avatar')->store($this->get_user_avatar_path(), 'public');

                // Extract the file name
                $filename = basename($avatarPath);

                // Extract the directory path without the filename
                $directoryPath = dirname($avatarPath);
                Log::info("New Avatar created $avatarPath/$filename");
                $file = [
                    'file_path' =>  "storage/$directoryPath",
                    'file_name' =>  $filename
                ];
            }
        } else {
            $file = "$request->user-avatar";
        }

        $user->name         = $request->name;
        $user->surname      = $request->surname;
        $user->email        = $request->email;
        $user->tel1         = $request->phone;
        $user->avatar       = json_encode($file);
        $user->telegram_id  = $request->telegram;
        $result = $user->save();

        if ($result) {
            Log::info("User $user have successfuly updated details");
            return response()->json(['message' => 'User details updated ..'], 200);
        } else {
            Log::warning("Error occurred updating details for user [ $user ]");
            return response()->json(['message' => 'Error occured while updating user details'], 500);
        }
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
}
