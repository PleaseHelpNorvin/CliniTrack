<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // ✅ Main Accounts
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => Hash::make('password123'),
            'role' => 'admin',
        ]);

        User::create([
            'name' => 'Nurse User',
            'email' => 'nurse@example.com',
            'password' => Hash::make('password123'),
            'role' => 'nurse',
        ]);

        User::create([
            'name' => 'Staff User',
            'email' => 'staff@example.com',
            'password' => Hash::make('password123'),
            'role' => 'staff',
        ]);

        // ✅ Generate 5 Admins
        for ($i = 1; $i <= 5; $i++) {
            User::create([
                'name' => "Admin User $i",
                'email' => "admin$i@example.com",
                'password' => Hash::make('password123'),
                'role' => 'admin',
            ]);
        }

        // ✅ Generate 5 Nurses
        for ($i = 1; $i <= 5; $i++) {
            User::create([
                'name' => "Nurse User $i",
                'email' => "nurse$i@example.com",
                'password' => Hash::make('password123'),
                'role' => 'nurse',
            ]);
        }

        // ✅ Generate 5 Staff
        for ($i = 1; $i <= 5; $i++) {
            User::create([
                'name' => "Staff User $i",
                'email' => "staff$i@example.com",
                'password' => Hash::make('password123'),
                'role' => 'staff',
            ]);
        }
    }
}
