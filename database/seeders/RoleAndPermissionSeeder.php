<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RoleAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $roles = [
            'admin' => 'Full Management',
            'hr' => 'Human Resources',
            'manager' => 'Department Manager',
            'employee' => 'Employee'
        ];

        foreach ($roles as $key => $description) {
            Role::create(['name' => $key, 'description' => $description]);
        }

        $permissions = [
            'company.view', 'company.create', 'company.update', 'company.delete',
            
            'employee.view', 'employee.create', 'employee.update', 'employee.delete',
            
            'department.view', 'department.create', 'department.update', 'department.delete',
            
            'leave.view', 'leave.create', 'leave.approve', 'leave.reject',
            
            'view.hierarchy', 'update.hierarchy', 'view.reports'
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        // Admin role 
        $adminRole = Role::findByName('admin');
        $adminRole->givePermissionTo(Permission::all());

        // HR role
        $hrRole = Role::findByName('hr');
        $hrRole->givePermissionTo([
            'employee.view', 'employee.create', 'employee.update', 'employee.delete',
            'department.view', 'department.create', 'department.update', 'department.delete',
            'conge.view', 'conge.approve', 'conge.reject',
            'view.hierarchy', 'update.hierarchy', 'view.reports'
        ]);

        // Manager role
        $managerRole = Role::findByName('manager');
        $managerRole->givePermissionTo([
            'employee.view', 'department.view', 'conge.view', 'conge.approve', 'conge.reject',
            'view.hierarchy', 'view.reports'
        ]);

        // Employee role
        $employeeRole = Role::findByName('employee');
        $employeeRole->givePermissionTo([
            'conge.create', 'conge.view'
        ]);
    }
}