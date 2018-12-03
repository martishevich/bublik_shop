<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaymentForOrder extends Model
{
    public function orders()
    {
        return $this->belongsToMany('App\Order');
    }
}
