<?php

namespace Database\Seeders;

use App\Models\User;
use App\Enums\UserRole;
use App\Models\Teacher;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\Hash;

class TeacherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID');
        $n = str_repeat('#', 18);
        $hp = "08". str_repeat('#', 10);
        for ($i=0; $i < 5; $i++) { 
            $nip = $faker->numerify($n);

            $user = User::factory()->create([
                'name' => $faker->name(),
                'username' => $nip,
                'email' => $faker->unique()->safeEmail,
                'password' => Hash::make('password'),
                'role' => UserRole::guru,
            ]);

            $teacher = Teacher::create([
                'user_id' => $user->id,
                'nip' => $nip,
                'no_telp' => $faker->numerify($hp),
                'alamat' => $faker->address()
            ]);
        }
    }
}
