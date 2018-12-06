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
                'o1.*',
                'p1.title AS payment',
                'p1.total',
                'ss1.status_id',
                'ss1.title AS delivering'
            ])
            ->fromRaw('orders AS o1
LEFT JOIN(
    SELECT order_id, SUM(price * quantity) AS total
    FROM order_prods GROUP BY order_id) AS p1
    ON  p1.order_id = o1.id
LEFT JOIN(
    SELECT s1.order_id, s1.status_id, s1.payment_id, s3.title
  FROM order_statuses AS s1
    LEFT JOIN (
        SELECT MAX(order_statuses.id) AS lastid, order_id
            FROM order_statuses
            GROUP BY order_id) s2 
        ON s1.id = s2.lastid
      LEFT JOIN status_orders s3
        ON s1.status_id = s3.id
        WHERE NOT s2.lastid IS null) ss1
    ON o1.id = ss1.order_id
    LEFT JOIN status_payments p1
    ON o1.payment_id = p1.id')
            ->where('ss1.status_id', '<>', null)
            ->where('ss1.payment_id', '<>', null)
            ->whereRaw('o1.id = ?', [$id])
            ->get();

    }

    public static function getList()
    {
        return static::query()
            ->select([
                'o1.*',
                'p1.title AS payment',
                'p1.total',
                'ss1.status_id',
                'ss1.title AS delivering'
            ])
            ->fromRaw('orders AS o1
LEFT JOIN(
    SELECT order_id, SUM(price * quantity) AS total
    FROM order_prods GROUP BY order_id) AS p1
    ON  p1.order_id = o1.id
LEFT JOIN(
    SELECT s1.order_id, s1.status_id, s3.title
  FROM order_statuses AS s1
    LEFT JOIN (
        SELECT MAX(order_statuses.id) AS lastid, order_id
            FROM order_statuses
            GROUP BY order_id) s2 
        ON s1.id = s2.lastid
      LEFT JOIN status_for_orders s3
        ON s1.status_id = s3.id
        WHERE NOT s2.lastid IS null) ss1
    ON o1.id = ss1.order_id
    LEFT JOIN payment_for_orders p1
    ON o1.payment_id = p1.id')
            ->where('ss1.status_id', '<>', null)
            ->orderBy('o1.id', 'DESC')
            ->get();
    }

    public static function getProds($id)
    {
        return static::query()
            ->select([
                'op.*',
                'p.name'
            ])
            ->fromRaw('order_prods AS op
    INNER JOIN products AS p ON op.product_id = p.id')
            ->whereRaw('op.order_id = ?', [$id])
            ->get();
    }

    public static function getOrdHistory($id)
    {
        return static::query()
            ->select([
                'sfo.title AS status',
                'os.comment',
                'os.created_at'
            ])
            ->fromRaw('order_statuses AS
        os INNER JOIN status_for_orders AS sfo ON os.status_id = sfo.id')
            ->whereRaw('os.order_id = ?', [$id])
            ->orderBy('os.id', 'DESC')
            ->get();
    }


}
