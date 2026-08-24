<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        // Test User (Normal user ke liye)
        User::updateOrCreate(
            ['email' => 'test@example.com'],
            [
                'name' => 'Test User',
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'is_admin' => 0,
            ]
        );

        // Permanent Admin - Ye kabhi delete nahi hoga
        User::updateOrCreate(
            ['email' => 'admin@tripura.com'],
            [
                'name' => 'Admin',
                'email_verified_at' => now(),
                'password' => Hash::make('password123'),
                'is_admin' => 1,
            ]
        );
    }
}