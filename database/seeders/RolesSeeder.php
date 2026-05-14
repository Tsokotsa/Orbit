<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use App\Models\User;

class RolesSeeder extends Seeder
{
    public function run()
    {
        // Create role
        Role::firstOrCreate(['name' => 'viewer']);

        // Create test user
        $user = User::firstOrCreate(
            ['email' => 'stelio@dev.local'],
            [
                'name' => 'Stelio',
                'password' => bcrypt('linux.123'),
            ]
        );

        // Assign role (viewer)
        if (!$user->hasRole('viewer')) {
            $user->assignRole('viewer');
        }
    }
}