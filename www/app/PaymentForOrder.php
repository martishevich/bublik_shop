<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaymentForOrder extends Model
{
    public function orderPayment(){
        return $this->hasMany('App\OrderStatus');
    }
}
