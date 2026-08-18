<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Enums\Geslacht;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\SizeChart;


class Kleding extends Model
{
    /** @use HasFactory<\Database\Factories\KledingFactory> */
    use HasFactory;


    protected $fillable = ['name','geslacht','prijs','omschrijving'];



    public function sizes()
    {
        return $this->belongsToMany(Size::class)->withPivot('stock');

    }

    public function fotos()
    {
        return $this->hasMany(KledingFoto::class);
    }

    public function sizeChart(): BelongsTo
    {
        return $this->belongsTo(SizeChart::class);
    }

    protected $casts = [
        'geslacht' => Geslacht::class,
    ];
}
