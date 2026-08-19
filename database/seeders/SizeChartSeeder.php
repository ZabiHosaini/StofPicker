<?php

namespace Database\Seeders;


use App\Models\SizeChart;
use Illuminate\Database\Seeder;

class SizeChartSeeder extends Seeder
{
    public function run(): void
    {
        SizeChart::updateOrCreate(
            [
                'name' => 'Heren',
            ],
            [
                'gender' => 'male',
                'is_active' => true,
            ]
        );
    }
}