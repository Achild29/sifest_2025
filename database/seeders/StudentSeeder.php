<?php

namespace Database\Seeders;

use App\Models\User;
use App\Enums\UserRole;
use App\Models\Student;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Faker\Factory as Faker;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID');
        $siswaUser = User::where('role', UserRole::siswa->value)->inRandomOrder()->first();
        Student::create([
            'user_id' => $siswaUser->id,
            'nisn' => $faker->randomNumber(5) . $faker->randomNumber(5),
            'alamat' => $faker->address(),
            'nama_wali_murid' => $faker->name('male'),
            'no_telp_wali' => '08' . $faker->randomNumber(5) . $faker->randomNumber(5),
        ]);
    }

    
}
