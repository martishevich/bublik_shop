<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class OrderStatus extends Model
{
    /**
     * @param Order $order
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

    public function statusForOrder()
    {
        return $this->belongsTo('App\StatusForOrder');
    }


    public static function setStatus(int $id, int $status)
    {
        $id_stat = 1;

        switch ((int)$id_stat) {
            case 9:
            default:
        }

        if ($status == 'abandonment') {
            $id_stat = 9;
        }
        if ($status == 'reshape') {
            $id_stat = 2;
        }
        if ($status == 'going') {
            $id_stat = 3;
        }
        if ($status == 'assembled') {
            $id_stat = 4;
        }
        if ($status == 'waiting_for_deliver') {
            $id_stat = 5;
        }
        if ($status == 'delivering') {
            $id_stat = 6;
        }
        if ($status == 'delivered') {
            $id_stat = 7;
        }
        if ($status == 'return in store') {
            $id_stat = 8;
        }

        DB::table('order_statuses')->insert(
            [
                'order_id'  => $id,
                'status_id' => $id_stat
            ]
        );
    }

}
