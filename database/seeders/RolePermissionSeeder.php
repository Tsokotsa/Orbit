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
            // Starlink Permissions
            'view starlink account',
            'view starlink terminals',
            'view starlink usage',
            'view starlink subscriber',
            'view starlink subscribers',
            'activate starlink line',
            'deactivate starlink line',
            'topup starlink line',
            'view starlink telemetry',
            // Asset Permissions
            'view assets',
            'create assets',
            'update assets',
            'manage vendors',
            'manage models',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // Roles
        $superAdmin = Role::firstOrCreate(['name' => 'Super Admin']);
        $superAdmin->syncPermissions($permissions);

        $noc = Role::firstOrCreate(['name' => 'NOC']);
        $support = Role::firstOrCreate(['name' => 'Support']);
        $viewer = Role::firstOrCreate(['name' => 'Viewer']);

        // Assign permissions
        $noc->givePermissionTo([
            //Starlink Permissions
            'view starlink account',
            'view starlink terminals',
            'view starlink usage',
            'view starlink subscriber',
            'view starlink subscribers',
            'activate starlink line',
            'deactivate starlink line',
            'topup starlink line',
            'view starlink telemetry',
            // Asset Permissions
            'view assets',
            'create assets',
            'update assets',
            'manage vendors',
            'manage models',
        ]);

        $support->givePermissionTo([
            // Starlink Permissions
            'view starlink account',
            'view starlink subscriber',
            'view starlink subscribers',
            'topup starlink line',
            // Asset Permissions
            'view assets',
            'create assets',
        ]);

        $viewer->givePermissionTo([
            // Starlink Permissions
            'view starlink account',
            'view starlink usage',
            // Asset Permissions
            'view assets',
        ]);
    }

}
