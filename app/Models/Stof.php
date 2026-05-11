<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stof extends Model
{
    /** @use HasFactory<\Database\Factories\StofFactory> */
    use HasFactory;

    protected $fillable =  [
        
        'name','fabrikant','categorie','prijs','kleur','status','vooraad','omschrijving','foto'
    
    ];
}
