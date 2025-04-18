<?php

namespace Database\Seeders;

use App\Models\User;
use App\Enums\UserRole;
use App\Models\Teacher;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TeacherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID');
        $teacherUser = User::where('role', UserRole::siswa->value)->inRandomOrder()->first();
        Teacher::create([
            'user_id' => $teacherUser->id,
            'nip' => $faker->randomNumber(9) . $faker->randomNumber(9),
            'no_telp' => '08' . $faker->randomNumber(5) . $faker->randomNumber(5),
            'alamat' =>  $faker->address(),
        ]);
    }
}
