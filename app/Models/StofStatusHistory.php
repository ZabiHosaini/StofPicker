<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StofStatusHistory extends Model
{
    protected $fillable = ['stof_id', 'status',];

public function stof()
{
    return $this->belongsTo(Stof::class);
}
}
