<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StatusForOrder extends Model
{
    public function orderStatus(){
        return $this->hasMany('App\OrderStatus');
    }
}
