<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $this->seedPermissions();
        $this->seedRoles();
    }

    private function seedPermissions()
    {
        $permissions = [

             // for user

             'view user',
             'create user',
             'edit user',
             'show user',
             'delete user',

              // for level

              'view level',
              'create level',
              'edit level',
              'show level',
              'delete level',
              
            // for instructor

            'view instructor',
            'create instructor',
            'edit instructor',
            'show instructor',
            'delete instructor',


            // for class

            'view class',
            'create class',
            'edit class',
            'show class',
            'delete class',

            // for Student

            'view student',
            'create student',
            'edit student',
            'show student',
            'delete student',

            
            // for Attendance

            'view attendance',
            'create attendance',
            'edit attendance',
            'show attendance',
            'mark_attendance',
            'delete attendance',

            // for Report

            'view report',
            'create report',
            'edit report',
            'show report',
            'delete report',

            // for subscription

            'view subscription',
            'create subscription',
            'edit subscription',
            'show subscription',
            'delete subscription',


            // for packages

            'view package',
            'create package',
            'edit package',
            'show package',
            'delete package',

            'view role',
            'create role',
            'edit role',
            'show role',
            'delete role',

        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }
    }

    private function seedRoles()
    {

        // Create roles
        $superAdminRole = Role::firstOrCreate(['name' => 'Super Admin']);
        // Assign permissions to roles
        $superAdminRole->givePermissionTo(Permission::all());
    }
}
