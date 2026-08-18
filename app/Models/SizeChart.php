<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\SizeChartSize;
use App\Models\Kleding;

class SizeChart extends Model
{
    protected $fillable = [
        'name',
        'gender',
        'is_active',
    ];

    public function sizes(): HasMany
    {
        return $this->hasMany(SizeChartSize::class);
    }

    public function kledings(): HasMany
    {
        return $this->hasMany(Kleding::class);
    }
}