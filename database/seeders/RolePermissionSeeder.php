<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

    public function run()
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        $permissions = [
            'view starlink account',
            'view starlink terminals',
            'view starlink usage',
            'view starlink subscriber',
            'view starlink subscribers',
            'activate starlink line',
            'deactivate starlink line',
            'topup starlink line',
            'view starlink telemetry',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // Roles
        $superAdmin = Role::firstOrCreate(['name' => 'Super Admin']);
        $noc = Role::firstOrCreate(['name' => 'NOC']);
        $support = Role::firstOrCreate(['name' => 'Support']);
        $viewer = Role::firstOrCreate(['name' => 'Viewer']);

        // Assign permissions
        $noc->givePermissionTo([
            'view starlink account',
            'view starlink terminals',
            'view starlink usage',
            'view starlink subscriber',
            'view starlink subscribers',
            'activate starlink line',
            'deactivate starlink line',
            'topup starlink line',
            'view starlink telemetry',
        ]);

        $support->givePermissionTo([
            'view starlink account',
            'view starlink subscriber',
            'view starlink subscribers',
            'topup starlink line',
        ]);

        $viewer->givePermissionTo([
            'view starlink account',
            'view starlink usage',
        ]);
    }

}
