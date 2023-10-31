<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Region;
use App\Models\Flower;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class RegionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('regions')->delete();
        $faker = Faker::create();
        $flower_ids = Flower::all()->pluck('id')->toArray(); 
        for ($i = 0; $i < 10; $i++) {
            Region::create([
                'flower_id' => $faker->randomElement($flower_ids),
                'region_name' => $faker->country,
            ]);
        }
    }
}
