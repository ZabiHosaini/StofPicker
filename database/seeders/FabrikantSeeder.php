<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Stof;
use DB;
use Faker\factory as faker;

class FabrikantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = faker::create();

        foreach (range(1,10) as $key => $value) {
         DB::table('fabrikants')->insert([

            'name' => $faker->company,
            'email' => $faker->email,
            'telefoon' => $faker->PhoneNumber,
            'adres' => $faker->address,
            'contactpersoon' => $faker->name,
            'logo' => $faker->imageUrl(200,200),
            
         ]);

        }
    }
}
