<?php

namespace Database\Seeders;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Seeder;

class RoleAndPermissionSeeder extends Seeder
{
    public function run()
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        $permissions = [
            // Company Management
            'manage-company-settings',
            'view-company-info',
            'edit-company-info',

            // User Management
            'manage-users',
            'create-user',
            'edit-user',
            'delete-user',
            'view-users',

            // Employee Management
            'manage-employees',
            'create-employee',
            'edit-employee',
            'delete-employee',
            'view-employees',
            'view-employee-details',
            'manage-employee-salary',
            'view-employee-documents',

            // Department Management
            'manage-departments',
            'create-department',
            'edit-department',
            'delete-department',
            'view-departments',
            'manage-department-hierarchy',

            // Document Management
            'manage-documents',
            'upload-documents',
            'delete-documents',
            'view-documents',

            // Career Management
            'manage-career-evolution',
            'create-promotion',
            'approve-promotion',
            'view-career-history'
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
        $roles = [
            'super-admin' => [
                '*'
            ],
            'company-admin' => [
                'manage-company-settings',
                'view-company-info',
                'edit-company-info',
                'manage-users',
                'manage-employees',
                'manage-departments',
                'manage-documents',
                'manage-career-evolution'
            ],
            'hr-manager' => [
                'view-company-info',
                'manage-employees',
                'view-departments',
                'manage-documents',
                'manage-career-evolution'
            ],
            'department-manager' => [
                'view-company-info',
                'view-employees',
                'view-employee-details',
                'view-departments',
                'view-documents',
                'create-promotion'
            ],
            'employee' => [
                'view-company-info',
                'view-employee-details',
                'view-documents'
            ]
        ];

        foreach ($roles as $roleName => $permissions) {
            $role = Role::create(['name' => $roleName]);
            if ($permissions[0] === '*') {
                $role->givePermissionTo(Permission::all());
            } else {
                $role->givePermissionTo($permissions);
            }
        }
    }
}
