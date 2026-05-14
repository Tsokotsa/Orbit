<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

class RolePermissionSeeder extends Seeder
{
    public function run()
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // 🔹 DEFINE PERMISSIONS
        $permissions = [

            // DASHBOARD
            'dashboard.view',

            // ASSETS
            'assets.view',
            'assets.create',
            'assets.update',
            'assets.delete',

            // VENDORS
            'vendors.view',
            'vendors.create',
            'vendors.update',

            // MODELS (technical)
            'models.view',
            'models.manage',

            // STARLINK
            'starlink.account.view',
            'starlink.terminals.view',
            'starlink.usage.view',
            'starlink.subscriber.view',
            'starlink.subscriber.list',
            'starlink.line.activate',
            'starlink.line.deactivate',
            'starlink.line.topup',
            'starlink.telemetry.view',
        ];

        // 🔹 CREATE PERMISSIONS
        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // 🔹 ROLES

        // SUPER ADMIN
        $superAdmin = Role::firstOrCreate(['name' => 'Super Admin']);
        $superAdmin->syncPermissions($permissions);

        // VIEWER (basic access)
        $viewer = Role::firstOrCreate(['name' => 'Viewer']);
        $viewer->syncPermissions([
            'dashboard.view',
            'assets.view',
            'starlink.account.view',
            'starlink.usage.view',
        ]);

        // ADMIN (non-technical, operational)
        $admin = Role::firstOrCreate(['name' => 'Admin']);
        $admin->syncPermissions([
            'dashboard.view',

            // assets
            'assets.view',
            'assets.create',
            'assets.update',

            // vendors
            'vendors.view',
            'vendors.create',
            'vendors.update',

            // starlink (limited)
            'starlink.account.view',
            'starlink.subscriber.view',
            'starlink.subscriber.list',
            'starlink.line.topup',
        ]);

        // NOC (technical team)
        $noc = Role::firstOrCreate(['name' => 'NOC']);
        $noc->syncPermissions([
            'dashboard.view',

            // assets (read only)
            'assets.view',

            // models (technical control)
            'models.view',
            'models.manage',

            // full starlink control
            'starlink.account.view',
            'starlink.terminals.view',
            'starlink.usage.view',
            'starlink.subscriber.view',
            'starlink.subscriber.list',
            'starlink.line.activate',
            'starlink.line.deactivate',
            'starlink.line.topup',
            'starlink.telemetry.view',
        ]);
    }
}