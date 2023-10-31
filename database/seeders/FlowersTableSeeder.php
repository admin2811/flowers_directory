<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Flower;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
class FlowersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('flowers')->delete();
        $faker = Faker::create();
        for ($i = 0; $i < 10; $i++) {
            Flower::create([
                'name' => $faker->name,
                'description' => $faker->text,
                'image_url' => $faker->imageUrl(400,300,'flower'),
            ]);
        }
    }
}
