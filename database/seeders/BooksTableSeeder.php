<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\Book;
class BooksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
      Book::query()->delete();
      $faker = Faker::create();
      for($i = 0; $i <10; $i++){
          Book::create([
              "Title"=>$faker->sentence(3),
              "Author"=>$faker->name,
              "Genre"=>$faker->word,
              "PublicationYear"=>$faker->year,
              "ISBN"=>$faker->numberBetween(1,10),
              "CoverImageURL"=>$faker->imageUrl(640,480)
          ]);
      }   
    }
}
