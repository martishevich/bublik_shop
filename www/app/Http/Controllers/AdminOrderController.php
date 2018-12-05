<?php

namespace App\Http\Controllers;

use App\Order;
use App\OrderProd;
use App\OrderStatus;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminOrderController extends Controller
{
    public function index()
    {
        $allOrd = Order::getList();
        return view('admin_order', compact('allOrd'));
    }

    public function show($id)
    {

        $order      = Order::getById($id);
        $allProds   = Order::getProds($id);
        $ordHistory = Order::getOrdHistory($id);

        return view('admin_order_show', compact('order', 'allProds', 'ordHistory'));

    }

    public function change($id)
    {
        $order = Order::getById($id);
        if ($_GET['status'] == 'boxing' && $order->canBoxing()) {
            $order->setBoxing();
        }
        return redirect("home/orders/$id");
    }

    /*$start = microtime(true);
    $finish = number_format(microtime(true) - $start, 2, ',', ' ');
    dd($finish);*/
}
