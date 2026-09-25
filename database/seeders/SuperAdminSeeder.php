<?php

namespace Database\Seeders;

use App\Models\SuperAdmin;
use Illuminate\Database\Seeder;

class SuperAdminSeeder extends Seeder
{
    public function run(): void
    {
        SuperAdmin::updateOrCreate(
            [
                'email' => 'superadmin@training.com',
            ],
            [
                'name' => 'Super Admin',
                'password' => 'Admin@12345',
                'status' => true,
            ]
        );
    }
}
