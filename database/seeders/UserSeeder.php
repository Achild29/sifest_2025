<?php

namespace Database\Seeders;

use App\Enums\UserRole;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID');
        User::factory()->createMany([
            [
                'username' => 'admin',
                'name' => $faker->name('male'),
                'email' => $faker->unique()->safeEmail,
                'password' => Hash::make('password'),
                'role' => UserRole::admin,
            ],
            [
                'username' => 'admin2',
                'name' => $faker->name('female'),
                'email' => $faker->unique()->safeEmail,
                'password' => Hash::make('password'),
                'role' => UserRole::admin,
            ]
        ]);
    }
}
