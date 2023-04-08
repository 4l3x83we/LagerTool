<?php
/**
 * Copyright (c) Alexander Guthmann.
 *
 * File: PermissionSeeder.php
 * User: ${USER}
 * Date: 30.${MONTH_NAME_FULL}.2023
 * Time: 21:24
 */

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionSeeder extends Seeder
{
    public function run(): void
    {
        Permission::create(['name' => 'create']);
        Permission::create(['name' => 'show']);
        Permission::create(['name' => 'update']);
        Permission::create(['name' => 'delete']);

        // Create Role
        $role = Role::create(['name' => 'superadmin']);
        $role->givePermissionTo(Permission::all());

        $role = Role::create(['name' => 'admin']);
        $role->givePermissionTo(Permission::all());

        $role = Role::create(['name' => 'workshop']);
        $role->givePermissionTo(['create', 'show', 'update']);

        $role = Role::create(['name' => 'user']);
        $role->givePermissionTo('show');
    }
}
