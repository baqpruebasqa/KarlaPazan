<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roleAdmin = Role::create(['name' => 'Administrador']);
        $roleCoordinador = Role::create(['name' => 'Coordinador']);
        $roleVisualizar = Role::create(['name' => 'Visualizador']);


        $permission_read = Permission::create(['name' => 'producto-list', 'guard_name' => 'web']);
        $permission_edit = Permission::create(['name' => 'producto-create', 'guard_name' => 'web']);
        $permission_write = Permission::create(['name' => 'producto-edit', 'guard_name' => 'web']);
        $permission_delete = Permission::create(['name' => 'producto-delete', 'guard_name' => 'web']);


        $permissions_admin = [$permission_read, $permission_edit, $permission_write, $permission_delete];

        $roleAdmin->syncPermissions($permissions_admin);
        $roleCoordinador->syncPermissions($permission_write);
        $roleVisualizar->syncPermissions($permission_read);


    }
}
