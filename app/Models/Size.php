<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Size extends Model
{
    protected $fillable = ['size','gender'];


    public function kledings()
    {
        return $this->belongsToMany(Kleding::class)->withPivot('stock');
    }

}
