<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Size extends Model
{
    protected $fillable = ['name'];


    public function kledings()
    {
        return $this->belongsToMany(Kleding::class)->withPivot('stock');
    }

}
