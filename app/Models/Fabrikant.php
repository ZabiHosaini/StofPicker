<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;

class Fabrikant extends Model
{
    /** @use HasFactory<\Database\Factories\FabrikantFactory> */
    use HasFactory;

    protected $fillable = ['name','adres','telefoon','contactPersoon','email','logo'];

    
    public function stofs(): HasMany
    {
        return $this->hasMany(Stof::class);
    }



}
