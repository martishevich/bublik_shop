<?php

namespace App\Http\Controllers;

use App\Order;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminOrderController extends Controller
{
    public function index()
    {
        $allOrd = DB::table('orders')
            ->leftJoin('order_prods', 'orders.id', '=', 'order_prods.order_id')
            ->leftJoin('order_statuses', 'orders.id', '=', 'order_statuses.order_id')
            ->selectRaw('orders.id, orders.fullname, orders.telephone, orders.email, orders.address, SUM(order_prods.price * order_prods.quantity) as total')
            ->groupBy('orders.id')
            ->get();
        return view('admin_order', compact('allOrd'));
    }

    public function show($id)
    {
        //$allOrd = Order::getListByStatus($id);
        $allOrd = DB::table('orders')
            ->leftJoin('order_prods', 'orders.id', '=', 'order_prods.order_id')
            ->leftJoin('order_statuses', 'orders.id', '=', 'order_statuses.order_id')
            ->leftJoin('status_for_orders', 'order_statuses.status_id', '=', 'status_for_orders.id')
            ->selectRaw('orders.id, orders.fullname, orders.telephone, orders.email, orders.address, status_for_orders.title, SUM(order_prods.price * order_prods.quantity) as total')
            ->groupBy('orders.id')
            ->get();

        return view('admin_order_show', compact('allOrd'));
    }
}
