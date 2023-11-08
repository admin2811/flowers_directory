<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Course;
use App\Models\Student;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
class CoursesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('courses')->delete();
        $faker = Faker::create();
        for ($i = 0; $i < 10; $i++) {
            Course::create([
                'course_name'=>$faker->words(2,true),
                'student_id'=>Student::inRandomOrder()->first()->id
            ]);
        };
    }
}
