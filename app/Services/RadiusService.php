<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class RadiusService
{

    protected $radius;

    public function __construct()
    {
        $this->radius = DB::connection('radius');
    }


    /*
    |--------------------------------------------------------------------------
    | CREATE USER
    |--------------------------------------------------------------------------
    */

    public function createUser(array $data): void
    {
        DB::transaction(function () use ($data) {

            /*
            |--------------------------------------------------------------------------
            | CREATE PASSWORD
            |--------------------------------------------------------------------------
            */

            $this->radius->table('radcheck')->insert([
                'username' => $data['username'],
                'attribute' => 'Cleartext-Password',
                'op' => ':=',
                'value' => $data['password'],
            ]);

            /*
            |--------------------------------------------------------------------------
            | ASSIGN PROFILE
            |--------------------------------------------------------------------------
            */

            $this->radius->table('radusergroup')->insert([
                'username' => $data['username'],
                'groupname' => $data['profile'],
                'priority' => 1,
            ]);

        });
    }

    /*
    |--------------------------------------------------------------------------
    | UPDATE USER
    |--------------------------------------------------------------------------
    */

    public function updateUser(string $username, array $data): void
    {
        DB::transaction(function () use ($username, $data) {

            /*
            |--------------------------------------------------------------------------
            | UPDATE PASSWORD
            |--------------------------------------------------------------------------
            */

            if (!empty($data['password'])) {

                $this->radius->table('radcheck')
                    ->where('username', $username)
                    ->where('attribute', 'Cleartext-Password')
                    ->update([
                        'value' => $data['password']
                    ]);
            }

            /*
            |--------------------------------------------------------------------------
            | UPDATE PROFILE
            |--------------------------------------------------------------------------
            */

            $this->radius->table('radusergroup')
                ->where('username', $username)
                ->delete();

            $this->radius->table('radusergroup')->insert([
                'username' => $username,
                'groupname' => $data['profile'],
                'priority' => 1,
            ]);

        });
    }

    /*
    |--------------------------------------------------------------------------
    | SUSPEND USER
    |--------------------------------------------------------------------------
    */

    public function suspendUser(string $username): void
    {
        $this->radius->table('radcheck')->updateOrInsert(
            [
                'username' => $username,
                'attribute' => 'Auth-Type',
            ],
            [
                'op' => ':=',
                'value' => 'Reject',
            ]
        );
    }

    /*
    |--------------------------------------------------------------------------
    | UNSUSPEND USER
    |--------------------------------------------------------------------------
    */

    public function unsuspendUser(string $username): void
    {
        $this->radius->table('radcheck')
            ->where('username', $username)
            ->where('attribute', 'Auth-Type')
            ->delete();
    }

    /*
    |--------------------------------------------------------------------------
    | DELETE USER
    |--------------------------------------------------------------------------
    */

    public function deleteUser(string $username): void
    {
        DB::transaction(function () use ($username) {

            $this->radius->table('radcheck')
                ->where('username', $username)
                ->delete();

            $this->radius->table('radreply')
                ->where('username', $username)
                ->delete();

            $this->radius->table('radusergroup')
                ->where('username', $username)
                ->delete();

        });
    }

    /*
    |--------------------------------------------------------------------------
    | CREATE PROFILE
    |--------------------------------------------------------------------------
    */

    public function createProfile(array $data): void
    {
        $this->radius->table('radgroupreply')->insert([

            'groupname' => $data['name'],
            'attribute' => 'Mikrotik-Rate-Limit',
            'op' => ':=',
            'value' => $data['download'] . '/' . $data['upload'],

        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | GET ONLINE USERS
    |--------------------------------------------------------------------------
    */

    public function onlineUsers()
    {
        return $this->radius->table('radacct')
            ->whereNull('acctstoptime')
            ->orderByDesc('acctstarttime')
            ->get();
    }
}