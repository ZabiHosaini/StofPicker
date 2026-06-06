<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;


class Orders extends Model
{
   protected $fillable = ['user_id','amount','aantalen','prijs'];



   
   public function kledings(): HasMany
   {
      return $this->hasMany(OrderKleding::class, 'order_id');   }
   }



