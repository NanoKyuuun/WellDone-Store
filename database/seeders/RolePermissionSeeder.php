<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userPermissions = [
            'edit' => Permission::create(['name' => 'edit']),
            'delete' => Permission::create(['name' => 'delete']),
            'create' => Permission::create(['name' => 'create']),
            'view' => Permission::create(['name' => 'view']),
        ];

        // Izin untuk admin
        $adminPermissions = [
            'edit-users' => Permission::create(['name' => 'edit-users']),
            'delete-users' => Permission::create(['name' => 'delete-users']),
            'create-users' => Permission::create(['name' => 'create-users']),
            'view-users' => Permission::create(['name' => 'view-users']),
        ];

        $role = Role::create(['name' => 'admin']);
        $role->givePermissionTo($adminPermissions, $userPermissions);
        $role = Role::create(['name' => 'user']);
        $role->givePermissionTo($userPermissions);
    }
}
