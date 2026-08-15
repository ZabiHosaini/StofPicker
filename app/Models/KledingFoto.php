<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KledingFoto extends Model
{
    protected $fillable = ['kleding_id','foto'];



    public function kleding()
    {
        return $this->belongsTo(Kleding::class);
    }

}
