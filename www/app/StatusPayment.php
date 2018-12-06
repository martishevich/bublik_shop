<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StatusPayment extends Model
{
    const STATUS_WAITING = 1;
    const STATUS_CASH    = 2;
    const STATUS_ROGA    = 3;
    const STATUS_REFUND  = 4;

    public static function getNamePayment(Order $order): ?self
    {
        return static::query()
            ->where(['id' => $order->getPaymentId()])
            ->get()
            ->first();
    }
}
