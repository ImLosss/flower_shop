<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

// reset cached roles and permissions
// app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

class PermissionRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::create(['name' => 'admin']);
        Role::create(['name' => 'member']);
        Permission::create(['name' => 'adminPanelAccess'])
        ->assignRole('admin');
    }
}
