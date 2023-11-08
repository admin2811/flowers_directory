<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\User;
class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::query()->delete();
        $faker = Faker::create();
        for($i = 0; $i <10; $i++){
            User::create([
                "name"=>$faker->name,
                "email"=>$faker->email,
                "password"=>password_hash($faker->password(6,8),PASSWORD_DEFAULT)
            ]);
        }
    }
}
