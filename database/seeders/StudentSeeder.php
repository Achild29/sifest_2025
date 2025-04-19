<?php

namespace Database\Seeders;

use App\Enums\UserRole;
use App\Models\User;
use App\Models\Student;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID');
        $n = str_repeat('#', 10);
        $hp = "08".$n;
        for ($i = 0; $i < 10; $i++) {
            $nisn = $faker->numerify($n);
    
            $user = User::factory()->create([
                'name' => $faker->firstName. ' ' . $faker->lastName,
                'username' => $nisn,
                'email' => $faker->unique()->safeEmail,
                'password' => Hash::make('password'),
                'role' => UserRole::siswa,
            ]);
    
            Student::create([
                'user_id' => $user->id,
                'nisn' => $nisn,
                'alamat' => $faker->address,
                'nama_wali_murid' => $faker->name,
                'no_telp_wali' => $faker->numerify($hp),
            ]);
        }
    }

    
}
