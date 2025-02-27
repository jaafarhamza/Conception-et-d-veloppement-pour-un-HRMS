<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Permission::create(['name' => 'manage users']);
        Permission::create(['name' => 'manage employees']);
        Permission::create(['name' => 'manage departments']);
        Permission::create(['name' => 'view reports']);

        $adminRole = Role::create(['name' => 'Admin']);
        $adminRole->givePermissionTo(Permission::all());

        $hrRole = Role::create(['name' => 'HR']);
        $hrRole->givePermissionTo('manage employees', 'manage departments', 'view reports');

        $managerRole = Role::create(['name' => 'Manager']);
        $managerRole->givePermissionTo('manage employees', 'view reports');

        $employeeRole = Role::create(['name' => 'Employee']);
        $employeeRole->givePermissionTo('view reports');
    }
}
