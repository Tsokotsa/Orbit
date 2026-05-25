<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RadGroupReply;
use App\Models\RadGroupCheck;
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

        /*
        |--------------------------------------------------------------------------
        | GET ALL UNIQUE GROUPS
        |--------------------------------------------------------------------------
        */
        $groupsReply = $db->table('radgroupreply')
            ->select('groupname');

        $groupsCheck = $db->table('radgroupcheck')
            ->select('groupname');

        $groups = $groupsReply
            ->union($groupsCheck);

        /*
        |--------------------------------------------------------------------------
        | FINAL PROFILE LIST
        |--------------------------------------------------------------------------
        */
        $profiles = $db->query()
            ->fromSub($groups, 'g')
            ->leftJoin('radusergroup as rug', 'rug.groupname', '=', 'g.groupname')
            ->select([
                'g.groupname',
                DB::raw('COUNT(DISTINCT rug.username) as users_count')
            ])
            ->groupBy('g.groupname')
            ->orderBy('g.groupname')
            ->get();

        /*
        |--------------------------------------------------------------------------
        | ATTACH ATTRIBUTES
        |--------------------------------------------------------------------------
        */
        foreach ($profiles as $profile) {

            $profile->reply = $db->table('radgroupreply')
                ->where('groupname', $profile->groupname)
                ->get();

            $profile->check = $db->table('radgroupcheck')
                ->where('groupname', $profile->groupname)
                ->get();

            $profile->attributes = [
                'reply' => $profile->reply,
                'check' => $profile->check,
            ];
        }

        return view(
            'radius.partials.profiles-list',
            compact('profiles')
        );
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

    // public function show($groupname)
    // {
    //     $db = DB::connection('radius');

    //     $reply = $db->table('radgroupreply')
    //         ->where('groupname', $groupname)
    //         ->get();

    //     $check = $db->table('radgroupcheck')
    //         ->where('groupname', $groupname)
    //         ->get();

    //     // defaults
    //     $profile = [
    //         'groupname' => $groupname,
    //         'download' => null,
    //         'upload' => null,
    //         'max_sessions' => null,
    //         'idle_timeout' => null,
    //         'auth_type' => null,
    //     ];

    //     foreach ($reply as $attr) {

    //         $attribute = strtolower(trim($attr->attribute ?? ''));
    //         $value = trim($attr->value ?? '');

    //         switch ($attribute) {

    //             case 'mikrotik-rate-limit':
    //                 $parts = explode('/', $value);
    //                 $profile['download'] = $parts[0] ?? null;
    //                 $profile['upload'] = $parts[1] ?? null;
    //                 break;

    //             case 'simultaneous-use':
    //                 $profile['max_sessions'] = $value;
    //                 break;

    //             case 'idle-timeout':
    //                 $profile['idle_timeout'] = $value;
    //                 break;

    //             case 'auth-type':
    //                 $profile['auth_type'] = $value;
    //                 break;
    //         }
    //     }

    //     // optional: include raw attributes if needed for debugging later
    //     return response()->json([
    //         'profile' => $profile,
    //         'reply' => $reply,
    //         'check' => $check,
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

        /*
        |--------------------------------------------------------------------------
        | DEFAULT PROFILE STRUCTURE
        |--------------------------------------------------------------------------
        */

        $profile = [
            'groupname' => $groupname,
            'download' => null,
            'upload' => null,
            'max_sessions' => null,
            'idle_timeout' => null,
            'auth_type' => null,
            'session_timeout' => null,
        ];

        /*
        |--------------------------------------------------------------------------
        | MERGE BOTH TABLES INTO SINGLE STRUCTURE
        |--------------------------------------------------------------------------
        */

        $allAttributes = $reply->merge($check);

        foreach ($allAttributes as $attr) {

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

                case 'session-timeout':
                    $profile['session_timeout'] = $value;
                    break;

                case 'auth-type':
                    $profile['auth_type'] = $value;
                    break;

                default:
                    // optional: store unknown attributes dynamically
                    $profile['attributes'][$attribute] = $value;
                    break;
            }
        }

        return response()->json([
            'profile' => $profile
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'download_speed' => 'required',
            'upload_speed' => 'required',
        ]);

        DB::connection('radius')->beginTransaction();

        try {

            $groupName = strtoupper(
                str_replace(' ', '_', trim($request->name))
            );

            /*
            |--------------------------------------------------------------------------
            | RATE LIMIT
            |--------------------------------------------------------------------------
            */

            $rateLimit = $request->download_speed . '/' . $request->upload_speed;

            /*
            |--------------------------------------------------------------------------
            | MIKROTIK RATE LIMIT
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
            | FRAMED IP
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
            | SESSION TIMEOUT
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
            | IDLE TIMEOUT
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
            | SIMULTANEOUS USE
            |--------------------------------------------------------------------------
            */

            if ($request->filled('simultaneous_use')) {

                RadGroupCheck::create([
                    'groupname' => $groupName,
                    'attribute' => 'Simultaneous-Use',
                    'op' => ':=',
                    'value' => $request->simultaneous_use
                ]);
            }

            /*
            |--------------------------------------------------------------------------
            | OPTIONAL PROFILE SUSPENSION
            |--------------------------------------------------------------------------
            */

            if ($request->status == 0) {

                RadGroupCheck::create([
                    'groupname' => $groupName,
                    'attribute' => 'Auth-Type',
                    'op' => ':=',
                    'value' => 'Reject'
                ]);
            }

            DB::connection('radius')->commit();

            return response()->json([
                'success' => true,
                'message' => 'Profile created successfully'
            ]);

        } catch (\Exception $e) {

            DB::connection('radius')->rollBack();

            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);

        }
    }

    public function update(Request $request, $group)
    {
        $db = DB::connection('radius');

        $db->beginTransaction();

        try {

            /*
            |--------------------------------------------------------------------------
            | NORMALIZE GROUP NAME (if editable)
            |--------------------------------------------------------------------------
            */

            $newGroup = strtoupper(str_replace(' ', '_', $request->groupname ?? $group));

            /*
            |--------------------------------------------------------------------------
            | UPDATE GROUP NAME IN radusergroup (if changed)
            |--------------------------------------------------------------------------
            */

            if ($newGroup !== $group) {

                $db->table('radusergroup')
                    ->where('groupname', $group)
                    ->update([
                        'groupname' => $newGroup
                    ]);

                $db->table('radgroupreply')
                    ->where('groupname', $group)
                    ->update([
                        'groupname' => $newGroup
                    ]);

                $db->table('radgroupcheck')
                    ->where('groupname', $group)
                    ->update([
                        'groupname' => $newGroup
                    ]);

                $group = $newGroup;
            }

            /*
            |--------------------------------------------------------------------------
            | HELPER: UPSERT ATTRIBUTE
            |--------------------------------------------------------------------------
            */

            $upsertReply = function ($attribute, $value) use ($db, $group) {

                $db->table('radgroupreply')->updateOrInsert(
                    [
                        'groupname' => $group,
                        'attribute' => $attribute
                    ],
                    [
                        'op' => ':=',
                        'value' => $value
                    ]
                );
            };

            $upsertCheck = function ($attribute, $value) use ($db, $group) {

                $db->table('radgroupcheck')->updateOrInsert(
                    [
                        'groupname' => $group,
                        'attribute' => $attribute
                    ],
                    [
                        'op' => ':=',
                        'value' => $value
                    ]
                );
            };

            /*
            |--------------------------------------------------------------------------
            | BANDWIDTH (Mikrotik Rate Limit)
            |--------------------------------------------------------------------------
            */

            if ($request->filled('download') && $request->filled('upload')) {

                $rateLimit = $request->download . '/' . $request->upload;

                $upsertReply('Mikrotik-Rate-Limit', $rateLimit);

            } else {

                $db->table('radgroupreply')
                    ->where('groupname', $group)
                    ->where('attribute', 'Mikrotik-Rate-Limit')
                    ->delete();
            }

            /*
            |--------------------------------------------------------------------------
            | SIMULTANEOUS USE
            |--------------------------------------------------------------------------
            */

            if ($request->filled('max_sessions')) {

                $upsertReply('Simultaneous-Use', $request->max_sessions);

            } else {

                $db->table('radgroupreply')
                    ->where('groupname', $group)
                    ->where('attribute', 'Simultaneous-Use')
                    ->delete();
            }

            /*
            |--------------------------------------------------------------------------
            | IDLE TIMEOUT
            |--------------------------------------------------------------------------
            */

            if ($request->filled('idle_timeout')) {

                $upsertReply('Idle-Timeout', $request->idle_timeout);

            } else {

                $db->table('radgroupreply')
                    ->where('groupname', $group)
                    ->where('attribute', 'Idle-Timeout')
                    ->delete();
            }

            /*
            |--------------------------------------------------------------------------
            | SESSION TIMEOUT (CHECK TABLE)
            |--------------------------------------------------------------------------
            */

            if ($request->filled('edit_session_timeout')) {

                $upsertReply('Session-Timeout', $request->edit_session_timeout);

            } else {

                $db->table('radgroupreply')
                    ->where('groupname', $group)
                    ->where('attribute', 'Session-Timeout')
                    ->delete();
            }

            /*
            |--------------------------------------------------------------------------
            | AUTH TYPE (CHECK TABLE)
            |--------------------------------------------------------------------------
            */

            if ($request->filled('profile_edit_auth_type')) {

                // $upsertCheck('Auth-Type', $request->edit_auth_type ? 'Accept' : 'Reject');
                $upsertCheck('Auth-Type', $request->profile_edit_auth_type);

            } else {

                $db->table('radgroupcheck')
                    ->where('groupname', $group)
                    ->where('attribute', 'Auth-Type')
                    ->delete();
            }

            $db->commit();

            return response()->json([
                'success' => true,
                'message' => 'Profile updated successfully'
            ]);

        } catch (\Exception $e) {

            $db->rollBack();

            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function destroy($group)
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
