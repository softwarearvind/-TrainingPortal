<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        $roles = [
            'Admin',
            'Trainer',
            'HR',
            'Student',
        ];

        foreach ($roles as $roleName) {

            Role::firstOrCreate([
                'name' => $roleName,
                'guard_name' => 'web',
            ]);
        }


        /*
        |--------------------------------------------------------------------------
        | Admin
        |--------------------------------------------------------------------------
        */

        $admin = Role::findByName('Admin', 'web');

        $admin->syncPermissions(
            Permission::where('guard_name', 'web')->get()
        );


        /*
        |--------------------------------------------------------------------------
        | Trainer
        |--------------------------------------------------------------------------
        */

        $trainer = Role::findByName('Trainer', 'web');

        $trainer->syncPermissions([

            'courses.view',
            'courses.create',
            'courses.edit',

            'videos.view',
            'videos.create',
            'videos.edit',

            'materials.view',
            'materials.create',
            'materials.edit',

            'batches.view',

            'assignments.view',
            'assignments.create',
            'assignments.edit',

            'tests.view',
            'tests.create',
            'tests.edit',

            'attendance.view',
            'attendance.manage',

            'results.view',
            'results.manage',

            'students.view',

        ]);


        /*
        |--------------------------------------------------------------------------
        | HR
        |--------------------------------------------------------------------------
        */

        $hr = Role::findByName('HR', 'web');

        $hr->syncPermissions([

            'users.view',

            'students.view',
            'students.create',
            'students.edit',

            'trainers.view',

            'batches.view',
            'batches.create',
            'batches.edit',

            'attendance.view',
            'attendance.manage',

            'results.view',

            'certificates.view',

            'reports.view',

        ]);


        /*
        |--------------------------------------------------------------------------
        | Student
        |--------------------------------------------------------------------------
        */

        $student = Role::findByName('Student', 'web');

        $student->syncPermissions([

            'courses.view',

            'videos.view',

            'materials.view',

            'assignments.view',

            'tests.view',

            'results.view',

            'certificates.view',

        ]);
    }
}
