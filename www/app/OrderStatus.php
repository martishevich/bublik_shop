<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderStatus extends Model
{
    public function order(){
        return $this->belongsTo('App\Order');
    }

    public function statusForOrder(){
        return $this->belongsTo('App\StatusForOrder');
    }
}
