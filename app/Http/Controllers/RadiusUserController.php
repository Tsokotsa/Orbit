<?php

namespace App\Http\Controllers;

use App\Models\Region;
use App\Models\ServiceType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Services\RadiusService;
use App\Models\PppoeUser;


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

        $regions = Region::where('is_active', 1)->get();

        $service_types = ServiceType::all();

        return view('radius.dashboard', compact(
            'user',
            'users',
            'profiles',
            'regions',
            'service_types'
        ));
    }

    public function listUsers()
    {
        // $user = auth()->user();

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

        return view('radius.partials.users-list', compact('users'));
    }

    public function getUser($username)
    {
        $db = DB::connection('radius');

        /*
        |--------------------------------------------------------------------------
        | USER PROFILE
        |--------------------------------------------------------------------------
        */

        $profile = $db->table('radusergroup')
            ->where('username', $username)
            ->value('groupname');

        /*
        |--------------------------------------------------------------------------
        | USER FRAMED IP
        |--------------------------------------------------------------------------
        */

        $framedIp = $db->table('radreply')
            ->where('username', $username)
            ->where('attribute', 'Framed-IP-Address')
            ->value('value');

        /*
        |--------------------------------------------------------------------------
        | USER STATUS
        |--------------------------------------------------------------------------
        */

        $suspended = $db->table('radcheck')
            ->where('username', $username)
            ->where('attribute', 'Auth-Type')
            ->where('value', 'Reject')
            ->exists();

        /*
        |--------------------------------------------------------------------------
        | USER RATE LIMIT
        |--------------------------------------------------------------------------
        */

        $userRateLimit = $db->table('radreply')
            ->where('username', $username)
            ->where('attribute', 'Mikrotik-Rate-Limit')
            ->value('value');

        /*
        |--------------------------------------------------------------------------
        | PROFILE RATE LIMIT
        |--------------------------------------------------------------------------
        */

        $profileRateLimit = null;

        if ($profile) {

            $profileRateLimit = $db->table('radgroupreply')
                ->where('groupname', $profile)
                ->where('attribute', 'Mikrotik-Rate-Limit')
                ->value('value');
        }

        /*
        |--------------------------------------------------------------------------
        | FINAL RATE LIMIT
        |--------------------------------------------------------------------------
        */

        $rateLimit = null;
        $rateLimitSource = null;

        if ($userRateLimit) {

            $rateLimit = $userRateLimit;
            $rateLimitSource = 'user';

        } elseif ($profileRateLimit) {

            $rateLimit = $profileRateLimit;
            $rateLimitSource = 'profile';
        }

        return response()->json([
            'success' => true,
            'username' => $username,
            'profile' => $profile,
            'framed_ip' => $framedIp,
            'suspended' => $suspended,

            'rate_limit' => $rateLimit,
            'rate_limit_source' => $rateLimitSource,
        ]);
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
            // 'client_id' => 'required|integer',
            'region_id' => 'required|integer',
            'service_type_id' => 'required|integer',
            'profile' => 'required|string',
        ]);

        try {
            return DB::transaction(function () use ($request) {

                /*
                |--------------------------------------------------------------------------
                | CREATE PPPoE USER (LOCKED CONTEXT FOR SAFETY)
                |--------------------------------------------------------------------------
                */

                $user = PppoeUser::query()
                    ->where('region_id', $request->region_id)
                    ->where('service_type_id', $request->service_type_id)
                    ->lockForUpdate()
                    ->create([
                        'client_id' => $request->client_id,
                        'region_id' => $request->region_id,
                        'service_type_id' => $request->service_type_id,
                    ]);

                /*
                |--------------------------------------------------------------------------
                | GENERATE USERNAME (NOW SAFE AFTER ID IS RESERVED)
                |--------------------------------------------------------------------------
                */

                $username = $user->generateUsername();

                /*
                |--------------------------------------------------------------------------
                | ENSURE UNIQUE USERNAME (SAFETY NET)
                |--------------------------------------------------------------------------
                */

                if (DB::connection('radius')->table('radcheck')->where('username', $username)->exists()) {
                    throw new \Exception("Username already exists in RADIUS: {$username}");
                }

                /*
                |--------------------------------------------------------------------------
                | PASSWORD GENERATION
                |--------------------------------------------------------------------------
                */

                $password = $request->filled('password')
                    ? $request->password
                    : substr(str_shuffle('ABCDEFGHJKLMNPQRSTUVWXYZ23456789'), 0, 10);

                /*
                |--------------------------------------------------------------------------
                | RADIUS - AUTH
                |--------------------------------------------------------------------------
                */

                DB::connection('radius')->table('radcheck')->insert([
                    'username' => $username,
                    'attribute' => 'Cleartext-Password',
                    'op' => ':=',
                    'value' => $password
                ]);

                /*
                |--------------------------------------------------------------------------
                | RADIUS - GROUP ASSIGNMENT
                |--------------------------------------------------------------------------
                */

                DB::connection('radius')->table('radusergroup')->insert([
                    'username' => $username,
                    'groupname' => $request->profile,
                    'priority' => 1
                ]);

                /*
                |--------------------------------------------------------------------------
                | RADIUS - STATIC IP (OPTIONAL)
                |--------------------------------------------------------------------------
                */

                if ($request->filled('framed_ip')) {
                    DB::connection('radius')->table('radreply')->insert([
                        'username' => $username,
                        'attribute' => 'Framed-IP-Address',
                        'op' => ':=',
                        'value' => $request->framed_ip
                    ]);
                }

                /*
                |--------------------------------------------------------------------------
                | FINAL RESPONSE
                |--------------------------------------------------------------------------
                */

                return response()->json([
                    'success' => true,
                    'message' => 'User created successfully',
                    'username' => $username,
                    'password' => $password
                ]);
            });

        } catch (\Exception $e) {

            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function update(Request $request)
    {
        $db = DB::connection('radius');

        $db->beginTransaction();

        try {

            $override = $request->boolean('enable_bandwidth_override');

            /*
            |--------------------------------------------------------------------------
            | PROFILE UPDATE (ALWAYS)
            |--------------------------------------------------------------------------
            */

            $db->table('radusergroup')->updateOrInsert(
                [
                    'username' => $request->username
                ],
                [
                    'groupname' => $request->profile
                ]
            );

            /*
            |--------------------------------------------------------------------------
            | FRAMED IP (UNCHANGED)
            |--------------------------------------------------------------------------
            */

            if ($request->filled('framed_ip')) {

                $db->table('radreply')->updateOrInsert(
                    [
                        'username' => $request->username,
                        'attribute' => 'Framed-IP-Address'
                    ],
                    [
                        'op' => ':=',
                        'value' => $request->framed_ip
                    ]
                );

            } else {

                $db->table('radreply')
                    ->where('username', $request->username)
                    ->where('attribute', 'Framed-IP-Address')
                    ->delete();
            }

            /*
            |--------------------------------------------------------------------------
            | RATE LIMIT (CORE RULE)
            |--------------------------------------------------------------------------
            */

            if (!$override) {

                /*
                |--------------------------------------------------------------------------
                | NO OVERRIDE → REMOVE USER LIMIT ALWAYS
                |--------------------------------------------------------------------------
                */

                $db->table('radreply')
                    ->where('username', $request->username)
                    ->where('attribute', 'Mikrotik-Rate-Limit')
                    ->delete();

            } else {

                /*
                |--------------------------------------------------------------------------
                | OVERRIDE ENABLED → APPLY USER LIMIT
                |--------------------------------------------------------------------------
                */

                if (
                    $request->filled('user_download_speed') &&
                    $request->filled('user_upload_speed')
                ) {

                    $db->table('radreply')->updateOrInsert(
                        [
                            'username' => $request->username,
                            'attribute' => 'Mikrotik-Rate-Limit'
                        ],
                        [
                            'op' => ':=',
                            'value' => $request->user_download_speed . '/' . $request->user_upload_speed
                        ]
                    );

                } else {

                    /*
                    |--------------------------------------------------------------------------
                    | OVERRIDE ENABLED BUT EMPTY VALUES → CLEAN UP
                    |--------------------------------------------------------------------------
                    */

                    $db->table('radreply')
                        ->where('username', $request->username)
                        ->where('attribute', 'Mikrotik-Rate-Limit')
                        ->delete();
                }
            }

            $db->commit();

            return response()->json([
                'success' => true,
                'message' => 'Subscriber updated successfully'
            ]);

        } catch (\Exception $e) {

            $db->rollBack();

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
        try {
            $this->radiusService->deleteUser($username);

            return response()->json([
                'message' => 'User deleted successfully'
            ]);
        } catch (\Throwable $e) {
            return response()->json([
                'message' => 'Deletion failed'
            ], 500);
        }
    }
}