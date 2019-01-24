<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Jobs;
use App\Order;
use Illuminate\Http\Request;

class AdminOrderController extends Controller
{
    public function index(Request $request)
    {
        $request->flash();
        $orders = Order::filterAndPagination($request);
        return view('admin.admin_order', compact('orders'));
    }
    
    public function show($id)
    {
        $order = Order::getById($id);
        return view('admin.admin_order_show', compact('order'));
    }
    
    public function change($id)
    {
        $order = Order::getById($id)->checkAndSetStatus($_GET);
        return redirect("home/orders/$id");
    }
    
    public function sendOrderList($id)
    {
        $order = Order::getById($id);
        Jobs\SendMessage::dispatch($order);
        return redirect("/home/orders/$id");
    }
    /*$start = microtime(true);
    $finish = number_format(microtime(true) - $start, 2, ',', ' ');
    dd($finish);*/
}
