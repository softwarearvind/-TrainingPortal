<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    public function run(): void
    {
        $permissions = [

            // Users
            'users.view',
            'users.create',
            'users.edit',
            'users.delete',

            // Courses
            'courses.view',
            'courses.create',
            'courses.edit',
            'courses.delete',

            // Categories
            'categories.view',
            'categories.create',
            'categories.edit',
            'categories.delete',

            // Trainers
            'trainers.view',
            'trainers.create',
            'trainers.edit',
            'trainers.delete',

            // Students
            'students.view',
            'students.create',
            'students.edit',
            'students.delete',

            // Batches
            'batches.view',
            'batches.create',
            'batches.edit',
            'batches.delete',

            // Videos
            'videos.view',
            'videos.create',
            'videos.edit',
            'videos.delete',

            // Study Materials
            'materials.view',
            'materials.create',
            'materials.edit',
            'materials.delete',

            // Assignments
            'assignments.view',
            'assignments.create',
            'assignments.edit',
            'assignments.delete',

            // Tests
            'tests.view',
            'tests.create',
            'tests.edit',
            'tests.delete',

            // Attendance
            'attendance.view',
            'attendance.manage',

            // Results
            'results.view',
            'results.manage',

            // Certificates
            'certificates.view',
            'certificates.create',
            'certificates.delete',

            // Payments
            'payments.view',
            'payments.manage',

            // Reports
            'reports.view',

        ];

        foreach ($permissions as $permission) {

            Permission::firstOrCreate([
                'name' => $permission,
                'guard_name' => 'web',
            ]);

        }
    }
}
