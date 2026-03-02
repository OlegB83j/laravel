<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * Creates 10 test users: 2 admins and 8 general role, with fake data.
     */
    public function run(): void
    {
        $faker = \Faker\Factory::create();

        // 2 admin users
        for ($i = 1; $i <= 2; $i++) {
            User::firstOrCreate(
                ['email' => "admin{$i}@example.com"],
                [
                    'name' => $faker->name(),
                    'password' => Hash::make('password'),
                    'role' => 'admin',
                    'phone' => $faker->phoneNumber(),
                    'is_active' => true,
                    'job_title' => $faker->randomElement(['Administrator', 'System Manager']),
                ]
            );
        }

        // 8 general role users
        for ($i = 1; $i <= 8; $i++) {
            User::firstOrCreate(
                ['email' => "user{$i}@example.com"],
                [
                    'name' => $faker->name(),
                    'password' => Hash::make('password'),
                    'role' => 'general',
                    'phone' => $faker->phoneNumber(),
                    'is_active' => $faker->boolean(90),
                    'job_title' => $faker->jobTitle(),
                ]
            );
        }
    }
}
