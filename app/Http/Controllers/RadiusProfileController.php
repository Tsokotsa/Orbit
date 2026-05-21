<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RadGroupReply;
use Illuminate\Support\Facades\DB;

class RadiusProfileController extends Controller
{

    // public function list()
    // {
    //     $connection = DB::connection('radius');

    //     // 1. Get all profiles
    //     $profiles = $connection->table('radusergroup')
    //         ->select('groupname')
    //         ->distinct()
    //         ->orderBy('groupname')
    //         ->get();

    //     // 2. Attach attributes per profile
    //     foreach ($profiles as $profile) {

    //         $profile->check = $connection->table('radgroupcheck')
    //             ->where('groupname', $profile->groupname)
    //             ->get();

    //         $profile->reply = $connection->table('radgroupreply')
    //             ->where('groupname', $profile->groupname)
    //             ->get();

    //         // optional: normalize key/value for easy JS usage
    //         $profile->attributes = [
    //             'check' => $profile->check->map(function ($item) {
    //                 return [
    //                     'attribute' => $item->attribute,
    //                     'op' => $item->op,
    //                     'value' => $item->value,
    //                 ];
    //             }),

    //             'reply' => $profile->reply->map(function ($item) {
    //                 return [
    //                     'attribute' => $item->attribute,
    //                     'op' => $item->op,
    //                     'value' => $item->value,
    //                 ];
    //             }),
    //         ];
    //     }

    //     return view('radius.partials.profiles-list', compact('profiles'));
    // }


    public function list()
    {
        $db = DB::connection('radius');

        $profiles = $db->table('radusergroup as rug')
            ->select([
                'rug.groupname',
                DB::raw('COUNT(DISTINCT rug.username) as users_count')
            ])
            ->groupBy('rug.groupname')
            ->orderBy('rug.groupname')
            ->get();

        // attach attributes per profile
        foreach ($profiles as $profile) {

            $profile->reply = $db->table('radgroupreply')
                ->where('groupname', $profile->groupname)
                ->get();

            $profile->check = $db->table('radgroupcheck')
                ->where('groupname', $profile->groupname)
                ->get();

            // flatten for JS modal use
            $profile->attributes = [
                'reply' => $profile->reply,
                'check' => $profile->check,
            ];
        }

        return view('radius.partials.profiles-list', compact('profiles'));
    }

    // public function show($group)
    // {
    //     $db = DB::connection('radius');

    //     // Get group name safely
    //     $groupname = $group;

    //     // PROFILE REPLY ATTRIBUTES (bandwidth, limits, etc)
    //     $reply = $db->table('radgroupreply')
    //         ->where('groupname', $groupname)
    //         ->get();

    //     // PROFILE CHECK ATTRIBUTES (auth rules)
    //     $check = $db->table('radgroupcheck')
    //         ->where('groupname', $groupname)
    //         ->get();

    //     return response()->json([
    //         'groupname' => $groupname,
    //         'reply' => $reply,
    //         'check' => $check
    //     ]);
    // }

    public function show($groupname)
    {
        $db = DB::connection('radius');

        $reply = $db->table('radgroupreply')
            ->where('groupname', $groupname)
            ->get();

        $check = $db->table('radgroupcheck')
            ->where('groupname', $groupname)
            ->get();

        // defaults
        $profile = [
            'groupname' => $groupname,
            'download' => null,
            'upload' => null,
            'max_sessions' => null,
            'idle_timeout' => null,
            'auth_type' => null,
        ];

        foreach ($reply as $attr) {

            $attribute = strtolower(trim($attr->attribute ?? ''));
            $value = trim($attr->value ?? '');

            switch ($attribute) {

                case 'mikrotik-rate-limit':
                    $parts = explode('/', $value);
                    $profile['download'] = $parts[0] ?? null;
                    $profile['upload'] = $parts[1] ?? null;
                    break;

                case 'simultaneous-use':
                    $profile['max_sessions'] = $value;
                    break;

                case 'idle-timeout':
                    $profile['idle_timeout'] = $value;
                    break;

                case 'auth-type':
                    $profile['auth_type'] = $value;
                    break;
            }
        }

        // optional: include raw attributes if needed for debugging later
        return response()->json([
            'profile' => $profile,
            'reply' => $reply,
            'check' => $check,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'download_speed' => 'required',
            'upload_speed' => 'required',
        ]);

        DB::beginTransaction();

        try {

            $groupName = strtoupper(
                str_replace(' ', '_', $request->name)
            );

            /*
            |--------------------------------------------------------------------------
            | Mikrotik Rate Limit
            |--------------------------------------------------------------------------
            |
            | Format:
            | download/upload
            |
            */

            $rateLimit = $request->upload_speed . '/' . $request->download_speed;

            /*
            |--------------------------------------------------------------------------
            | Mikrotik-Rate-Limit
            |--------------------------------------------------------------------------
            */

            RadGroupReply::create([
                'groupname' => $groupName,
                'attribute' => 'Mikrotik-Rate-Limit',
                'op' => ':=',
                'value' => $rateLimit
            ]);

            /*
            |--------------------------------------------------------------------------
            | Simultaneous-Use
            |--------------------------------------------------------------------------
            */

            if ($request->filled('simultaneous_use')) {

                RadGroupReply::create([
                    'groupname' => $groupName,
                    'attribute' => 'Simultaneous-Use',
                    'op' => ':=',
                    'value' => $request->simultaneous_use
                ]);
            }

            /*
            |--------------------------------------------------------------------------
            | Framed-IP-Address
            |--------------------------------------------------------------------------
            */

            if ($request->filled('framed_ip')) {

                RadGroupReply::create([
                    'groupname' => $groupName,
                    'attribute' => 'Framed-IP-Address',
                    'op' => ':=',
                    'value' => $request->framed_ip
                ]);
            }

            /*
            |--------------------------------------------------------------------------
            | Session-Timeout
            |--------------------------------------------------------------------------
            */

            if ($request->filled('session_timeout')) {

                RadGroupReply::create([
                    'groupname' => $groupName,
                    'attribute' => 'Session-Timeout',
                    'op' => ':=',
                    'value' => $request->session_timeout
                ]);
            }

            /*
            |--------------------------------------------------------------------------
            | Idle-Timeout
            |--------------------------------------------------------------------------
            */

            if ($request->filled('idle_timeout')) {

                RadGroupReply::create([
                    'groupname' => $groupName,
                    'attribute' => 'Idle-Timeout',
                    'op' => ':=',
                    'value' => $request->idle_timeout
                ]);
            }

            /*
            |--------------------------------------------------------------------------
            | Profile Status
            |--------------------------------------------------------------------------
            */

            RadGroupReply::create([
                'groupname' => $groupName,
                'attribute' => 'Auth-Type',
                'op' => ':=',
                'value' => $request->status ? 'Accept' : 'Reject'
            ]);

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Profile created successfully'
            ]);

        } catch (\Exception $e) {

            DB::rollBack();

            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);

        }
    }

    public function delete($group)
    {
        DB::connection('radius')->table('radusergroup')
            ->where('groupname', $group)
            ->delete();

        DB::connection('radius')->table('radgroupreply')
            ->where('groupname', $group)
            ->delete();

        DB::connection('radius')->table('radgroupcheck')
            ->where('groupname', $group)
            ->delete();

        return response()->json(['success' => true]);
    }
}
