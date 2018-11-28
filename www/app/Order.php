<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public function orderProd(){
        return $this->hasMany('App\OrderProd');
    }

    public function orderData(){
        return $this->hasMany('App\OrderData');
    }

    public function orderStatus(){
        return $this->hasMany('App\OrderStatus');
    }
}
