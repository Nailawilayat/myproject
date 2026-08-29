<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        // Roles
        $admin = Role::firstOrCreate([
            'name' => 'admin',
            'guard_name' => 'web',
        ]);

        Role::firstOrCreate([
            'name' => 'teacher',
            'guard_name' => 'web',
        ]);

        Role::firstOrCreate([
            'name' => 'student',
            'guard_name' => 'web',
        ]);

        // Permissions
        $permissions = [
            'manage courses',
            'manage books',
            'manage pricing',
            'view apply requests',
            'manage users',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate([
                'name' => $permission,
                'guard_name' => 'web',
            ]);
        }

        // Give all permissions to admin
        $admin->syncPermissions(Permission::all());
    }
}