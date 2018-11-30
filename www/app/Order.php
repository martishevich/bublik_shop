<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public function orderProd()
    {
        return $this->hasMany('App\OrderProd');
    }

    public function orderData()
    {
        return $this->hasMany('App\OrderData');
    }

    public function orderStatus()
    {
        return $this->hasMany('App\OrderStatus');
    }

    public function payments()
    {
        return $this->belongsToMany('App\PaymentForOrder');
    }
    /**
     * @param StatusForOrder|null $statusForOrder
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Query\Builder[]|\Illuminate\Support\Collection
     */
    public static function getListByStatus($id, StatusForOrder $statusForOrder = null)
    {
        return static::query()
            ->select([
                'o.*',
                'ss1.status_id',
                'ss1.created_at AS status_created_at'
            ])
            ->fromRaw('
            (
                SELECT
                 s1.*
                FROM
                 order_statuses AS s1
                 LEFT JOIN order_statuses AS s2 ON 
                    s1.order_id = s2.order_id 
                    AND s1.created_at < s2.created_at
                WHERE 
                    s2.id IS NULL
            ) AS ss1
            LEFT JOIN 
            (
                SELECT
                 s1.*
                FROM
                 order_statuses AS s1
                 LEFT JOIN order_statuses AS s2 ON 
                    s1.order_id = s2.order_id 
                    AND s1.created_at < s2.created_at
                WHERE 
                    s2.id IS NULL
            ) AS s3 ON 
                ss1.order_id = s3.order_id 
                AND ss1.id < s3.id
            INNER JOIN orders AS o ON o.id = ss1.order_id')
            ->where('s3.id', '=', null)
            ->where('o.id','=', $id)
            //->orderBy('o.id', 'DESC')
            ->get();
    }


}
