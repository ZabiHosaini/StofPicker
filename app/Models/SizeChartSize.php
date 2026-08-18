<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SizeChartSize extends Model
{
    protected $fillable = [
        'size_chart_id',
        'size',
        'chest_min',
        'chest_max',
        'waist_min',
        'waist_max',
        'hips_min',
        'hips_max',
        'body_length_min',
        'body_length_max',
        'shoulder_min',
        'shoulder_max',
        'sleeve_length_min',
        'sleeve_length_max',
        'inseam_min',
        'inseam_max',
    ];

    public function sizeChart(): BelongsTo
    {
        return $this->belongsTo(SizeChart::class);
    }
}