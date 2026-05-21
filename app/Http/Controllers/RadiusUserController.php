<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Services\RadiusService;


class RadiusUserController extends Controller
{

    protected $radius;

    public function __construct(protected RadiusService $radiusService)
    {
        $this->radius = DB::connection('radius');
    }

    public function index()
    {
        $user = Auth()->user();

        $users = $this->radius->table('radcheck')
            ->select('username')
            ->groupBy('username')
            ->get();

        $profiles = $this->radius->table('radgroupreply')
            ->select('groupname')
            ->groupBy('groupname')
            ->get();

        return view('radius.dashboard', compact(
            'user',
            'users',
            'profiles'
        ));
    }

    public function listUsers()
    {
        $user = auth()->user();

        $users = DB::connection('radius')
            ->table('radcheck as rc')

            /*
            |--------------------------------------------------------------------------
            | PROFILE
            |--------------------------------------------------------------------------
            */
            ->leftJoin('radusergroup as rug', 'rug.username', '=', 'rc.username')

            /*
            |--------------------------------------------------------------------------
            | FRAMED IP (radreply)
            |--------------------------------------------------------------------------
            */
            ->leftJoin('radreply as rr', function ($join) {
                $join->on('rr.username', '=', 'rc.username')
                    ->where('rr.attribute', '=', 'Framed-IP-Address');
            })

            /*
            |--------------------------------------------------------------------------
            | ACTIVE SESSION (LATEST ONLY radacct)
            |--------------------------------------------------------------------------
            */
            ->leftJoinSub(function ($query) {
                $query->select([
                    'ra1.username',
                    'ra1.framedipaddress',
                    'ra1.callingstationid',
                    'ra1.acctstarttime',
                    'ra1.nasipaddress'
                ])
                    ->from('radacct as ra1')
                    ->whereNull('ra1.acctstoptime')
                    ->whereRaw('ra1.acctstarttime = (
                    SELECT MAX(ra2.acctstarttime)
                    FROM radacct ra2
                    WHERE ra2.username = ra1.username
                    AND ra2.acctstoptime IS NULL
                )');
            }, 'ra', function ($join) {
                $join->on('ra.username', '=', 'rc.username');
            })

            /*
            |--------------------------------------------------------------------------
            | AUTH-TYPE (SUSPENSION FLAG)
            |--------------------------------------------------------------------------
            */
            ->leftJoin('radcheck as rc_auth', function ($join) {
                $join->on('rc_auth.username', '=', 'rc.username')
                    ->where('rc_auth.attribute', '=', 'Auth-Type');
            })

            /*
            |--------------------------------------------------------------------------
            | SELECT
            |--------------------------------------------------------------------------
            */
            ->select([
                'rc.username',

                DB::raw('MAX(rug.groupname) as profile'),
                DB::raw('MAX(rr.value) as framed_ip'),

                'ra.framedipaddress',
                'ra.callingstationid',
                'ra.acctstarttime',
                'ra.nasipaddress',

                DB::raw("
                CASE
                    WHEN ra.username IS NOT NULL
                    THEN 'online'
                    ELSE 'offline'
                END as status
            "),

                DB::raw("
                MAX(CASE
                    WHEN rc_auth.attribute = 'Auth-Type'
                    THEN rc_auth.value
                END) as auth_type
            ")
            ])

            ->where('rc.attribute', 'Cleartext-Password')

            ->groupBy('rc.username')

            ->orderBy('rc.username')

            ->get();

        return view('radius.partials.users-list', compact('users', 'user'));
    }

    public function disconnect(Request $request)
    {
        DB::connection('radius')
            ->table('radacct')
            ->where('username', $request->username)
            ->whereNull('acctstoptime')
            ->update([
                'acctstoptime' => now()
            ]);

        return response()->json([
            'success' => true
        ]);
    }

    public function suspend(Request $request)
    {
        $username = $request->username;

        DB::connection('radius')
            ->table('radcheck')
            ->updateOrInsert(
                [
                    'username' => $username,
                    'attribute' => 'Auth-Type',
                ],
                [
                    'op' => ':=',
                    'value' => 'Reject',
                ]
            );

        return response()->json([
            'success' => true,
            'message' => 'User suspended successfully'
        ]);
    }

    public function unsuspend(Request $request)
    {
        $username = $request->username;

        DB::connection('radius')
            ->table('radcheck')
            ->where('username', $username)
            ->where('attribute', 'Auth-Type')
            ->delete();

        return response()->json([
            'success' => true,
            'message' => 'User restored successfully'
        ]);
    }

    public function resetPassword(Request $request)
    {
        $password = substr(str_shuffle('ABCDEFGHJKLMNPQRSTUVWXYZ23456789'), 0, 8);

        DB::connection('radius')
            ->table('radcheck')
            ->where('username', $request->username)
            ->where('attribute', 'Cleartext-Password')
            ->update([
                'value' => $password
            ]);

        return response()->json([
            'success' => true,
            'password' => $password
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'service_type' => 'required',
            'profile' => 'required',
        ]);

        try {

            DB::connection('radius')->beginTransaction();

            /*
            |--------------------------------------------------------------------------
            | PASSWORD
            |--------------------------------------------------------------------------
            */

            $password = $request->filled('password')
                ? $request->password
                : substr(str_shuffle('ABCDEFGHJKLMNPQRSTUVWXYZ23456789'), 0, 10);

            /*
            |--------------------------------------------------------------------------
            | RADCHECK (AUTH)
            |--------------------------------------------------------------------------
            */

            DB::connection('radius')->table('radcheck')->insert([
                'username' => $request->username,
                'attribute' => 'Cleartext-Password',
                'op' => ':=',
                'value' => $password
            ]);

            /*
            |--------------------------------------------------------------------------
            | LINK USER TO PROFILE
            |--------------------------------------------------------------------------
            */

            DB::connection('radius')->table('radusergroup')->insert([
                'username' => $request->username,
                'groupname' => $request->profile,
                'priority' => 1
            ]);

            /*
            |--------------------------------------------------------------------------
            | FRAMED IP (USER LEVEL)
            |--------------------------------------------------------------------------
            */

            if ($request->filled('framed_ip')) {

                DB::connection('radius')->table('radreply')->insert([
                    'username' => $request->username,
                    'attribute' => 'Framed-IP-Address',
                    'op' => ':=',
                    'value' => $request->framed_ip
                ]);
            }

            DB::connection('radius')->commit();

            return response()->json([
                'success' => true,
                'message' => 'User created successfully',
                'username' => $request->username,
                'password' => $password
            ]);

        } catch (\Exception $e) {

            DB::connection('radius')->rollBack();

            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function update(Request $request)
    {
        DB::connection('radius')->beginTransaction();

        try {

            /*
            |--------------------------------------------------------------------------
            | PROFILE
            |--------------------------------------------------------------------------
            */

            DB::connection('radius')
                ->table('radusergroup')
                ->where('username', $request->username)
                ->update([
                    'groupname' => $request->profile
                ]);

            /*
            |--------------------------------------------------------------------------
            | FRAMED IP
            |--------------------------------------------------------------------------
            */

            DB::connection('radius')
                ->table('radreply')
                ->updateOrInsert(
                    [
                        'username' => $request->username,
                        'attribute' => 'Framed-IP-Address'
                    ],
                    [
                        'op' => ':=',
                        'value' => $request->framed_ip
                    ]
                );

            /*
            |--------------------------------------------------------------------------
            | DOWNLOAD
            |--------------------------------------------------------------------------
            */

            DB::connection('radius')
                ->table('radreply')
                ->updateOrInsert(
                    [
                        'username' => $request->username,
                        'attribute' => 'Mikrotik-Rate-Limit'
                    ],
                    [
                        'op' => ':=',
                        'value' => $request->download_speed . '/' . $request->upload_speed
                    ]
                );

            DB::connection('radius')->commit();

            return response()->json([
                'success' => true
            ]);

        } catch (\Exception $e) {

            DB::connection('radius')->rollBack();

            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);

        }
    }

    // public function unsuspend(string $username)
    // {
    //     $this->radiusService->unsuspendUser($username);

    //     return back()->with('success', 'User activated');
    // }

    public function destroy(string $username)
    {
        $this->radiusService->deleteUser($username);

        return back()->with('success', 'User deleted');
    }
}