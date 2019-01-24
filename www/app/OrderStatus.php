<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class OrderStatus extends Model
{
    /**
     * @param  Order $order
     * @return OrderStatus|null
     */
    public static function getLastByOrder(Order $order): ?self
    {
        return static::query()
            ->where(['order_id' => $order->getKey()])
            ->orderBy('id', 'DESC')
            ->limit(1)
            ->get()
            ->first();
    }
    
    public function order()
    {
        return $this->belongsTo('App\Order');
    }
    
    public function statuses()
    {
        return $this->belongsTo('App\StatusOrder', 'status_id');
    }
    
    public function payments()
    {
        return $this->belongsTo('App\StatusPayment', 'payment_id');
    }
}
