<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StatusPayment extends Model
{


    public static function getNamePayment(Order $order): ?self
    {
        return static::query()
            ->where(['id' => $order->getPaymentId()])
            ->get()
            ->first();
    }
}
