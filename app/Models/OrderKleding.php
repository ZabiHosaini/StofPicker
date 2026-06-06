<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderKleding extends Model
{
    protected $fillable = ['order_id','kleding_id','status','aantalen','stripe_id'];
}
