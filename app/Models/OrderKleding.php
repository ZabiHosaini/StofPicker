<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OrderKleding extends Model
{
    protected $fillable = ['order_id','kleding_id','status','prijs','aantalen','stripe_id'];

    public function order(): BelongsTo
    {
        return $this->belongsTo(Orders::class, 'order_id');
    }

    public function kleding(): BelongsTo
    {
        return $this->belongsTo(Kleding::class, 'kleding_id');
    }
}
