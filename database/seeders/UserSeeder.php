<?php

namespace Database\Seeders;

use App\Enums\UserRole;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

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
                'email' => $faker->email(),
                'password' => bcrypt('password'),
                'role' => UserRole::admin->value
            ],
            [
                'username' => 'guru1',
                'name' => $faker->name(),
                'email' => $faker->email(),
                'password' => bcrypt('password'),
                'role' => UserRole::guru->value,
            ],
        ]);
    }
}
