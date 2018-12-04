<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StatusForOrder extends Model
{
    const STATUS_PROCESSING = 1;


    public function orderStatus(){
        return $this->hasMany('App\OrderStatus');
    }
}
