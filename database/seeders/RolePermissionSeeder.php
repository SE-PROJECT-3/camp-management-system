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

        $manageFamilies = Permission::firstOrCreate(['name' => 'manage families']);
        $viewFamilies = Permission::firstOrCreate(['name' => 'view families']);

        $admin = Role::firstOrCreate(['name' => 'admin']);
        $campAdmin = Role::firstOrCreate(['name' => 'camp_admin']);
        $user = Role::firstOrCreate(['name' => 'user']);

        $admin->givePermissionTo($manageFamilies);
        $admin->givePermissionTo($viewFamilies);

        $campAdmin->givePermissionTo($viewFamilies);
    }
    
}