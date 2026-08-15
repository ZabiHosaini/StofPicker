<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;

class Stof extends Model
{
    /** @use HasFactory<\Database\Factories\StofFactory> */
    use HasFactory;

    protected $fillable =  [
        
        'name','fabrikant_id','categorie','prijs','kleur','status','vooraad','breed','omschrijving','foto'
    
    ];

    public function fabrikant(): BelongsTo
    {
        return $this->belongsTo(Fabrikant::class);
    }

    public function statusHistory()
{
    return $this->hasMany(StofStatusHistory::class)
        ->latest();
}

}
