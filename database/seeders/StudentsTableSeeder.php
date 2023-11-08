<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Student;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class StudentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('students')->delete();
        $faker = Faker::create();
        for ($i = 0; $i < 50; $i++) {
            Student::create([
                'student_name'=>$faker->name,
                'student_code'=>$faker->unique()->randomNumber(9),
                'gender' => $faker->randomElement(['male', 'female']),
                'dob'=>$faker->date($format = 'Y-m-d', $max = 'now'),
                'student_photo'=>$faker->imageUrl(400,300,'people'),
            ]);
        }
    }
}
