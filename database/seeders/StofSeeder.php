<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Faker\Factory as Faker;
use DB;

class StofSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        $categorie = ['pelastic', 'wol', 'polyster', 'recycle'];

        $faker = Faker:: create();

        foreach (range(1,10) as $key => $value) {
            DB::table('stofs')->insert([
                'name' => $faker->name,
                'fabrikant_id' => '1',
                'categorie' => $faker->randomElement($categorie),
                'prijs' => $faker->randomFloat(2, 10, 1000), // creates a float between 10 and 1000 with 2 decimals.
                'kleur' => $faker->hexColor(),
                'status' => 'onderweg',
                'breed' => $faker->numberBetween(100, 200),
                'vooraad' => $faker->numberBetween(0, 500),
                'foto' => $faker->imageUrl(200,200),
                'omschrijving' => $faker->text,    

            ]);
        }
    }
}
