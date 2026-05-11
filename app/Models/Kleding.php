<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Enums\Geslacht;

class Kleding extends Model
{
    /** @use HasFactory<\Database\Factories\KledingFactory> */
    use HasFactory;


    protected $fillable = ['name','geslacht','prijs','omschrijving'];



    public function sizes()
    {
        return $this->belongsToMany(Size::class)->withPivot('stock');

    }

    protected $casts = [
        'geslacht' => Geslacht::class,
    ];
}
