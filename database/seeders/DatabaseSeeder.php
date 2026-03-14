<?php

namespace Database\Seeders;

use App\Models\SuperAdmin;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $email = config('app.default_admin_email', 'admin@digitaledu.com');
        $password = config('app.default_admin_password', 'password');
        $fullName = config('app.default_admin_name', 'Super Admin');

        $admin = SuperAdmin::firstOrCreate(
            ['email' => $email],
            ['full_name' => $fullName]
        );

        User::firstOrCreate(
            [
                'email' => $email,
                'role' => 'super_admin',
                'role_id' => $admin->id,
            ],
            [
                'name' => $fullName,
                'password' => Hash::make($password),
            ]
        );
    }
}
