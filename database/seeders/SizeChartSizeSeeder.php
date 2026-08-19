<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SizeChart;
use App\Models\SizeChartSize;

class SizeChartSizeSeeder extends Seeder
{
    public function run(): void
    {
        $sizeChart = SizeChart::where('name', 'Heren')->firstOrFail();

        SizeChartSize::updateOrCreate(
            [
                'size_chart_id' => $sizeChart->id,
                'size' => 'S',
            ],
            [
                'chest_min' => 86,
                'chest_max' => 94,
                'waist_min' => 70,
                'waist_max' => 78,
                'hips_min' => 86,
                'hips_max' => 94,
                'body_length_min' => 165,
                'body_length_max' => 175,
                'shoulder_min' => 40,
                'shoulder_max' => 44,
                'sleeve_length_min' => 58,
                'sleeve_length_max' => 62,
                'inseam_min' => 76,
                'inseam_max' => 82,
            ]
        );

        SizeChartSize::updateOrCreate(
            [
                'size_chart_id' => $sizeChart->id,
                'size' => 'M',
            ],
            [
                'chest_min' => 94,
                'chest_max' => 102,
                'waist_min' => 78,
                'waist_max' => 86,
                'hips_min' => 94,
                'hips_max' => 102,
                'body_length_min' => 170,
                'body_length_max' => 180,
                'shoulder_min' => 44,
                'shoulder_max' => 48,
                'sleeve_length_min' => 60,
                'sleeve_length_max' => 64,
                'inseam_min' => 78,
                'inseam_max' => 84,
            ]
        );

        SizeChartSize::updateOrCreate(
            [
                'size_chart_id' => $sizeChart->id,
                'size' => 'L',
            ],
            [
                'chest_min' => 102,
                'chest_max' => 110,
                'waist_min' => 86,
                'waist_max' => 94,
                'hips_min' => 102,
                'hips_max' => 110,
                'body_length_min' => 175,
                'body_length_max' => 185,
                'shoulder_min' => 48,
                'shoulder_max' => 52,
                'sleeve_length_min' => 62,
                'shoulder_max' => 52,
                'sleeve_length_max' => 66,
                'inseam_min' => 80,
                'inseam_max' => 86,
            ]
        );
    }
}