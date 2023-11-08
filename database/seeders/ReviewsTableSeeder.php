<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\Review;
use Illuminate\Support\Facades\DB;
class ReviewsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        Review::query()->delete();
        $idUser = DB::table('users')->pluck('id');
        $idBook = DB::table('books')->pluck('BookID');
        for($i = 0; $i < 10; $i++){
            Review::create([
                "BookID"=>$faker->randomElement($idBook),
                "UserID"=>$faker->randomElement($idUser),
                "Rating"=>$faker->numberBetween(1,5),
                "ReviewText"=>$faker->text(200),
                "ReviewDate"=>$faker->date()
            ]);
        }
    }
}
