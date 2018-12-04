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
//        if (isset($_POST['status-order-edit'])){
//            OrderStatus::setStatus($id, $_POST['status-order-edit']);
//        }

        $order = Order::getById($id);

        if(empty($order)) {

            dd('OOOOOPs');
        }

        $allProds = Order::getProds($id);
        $ordHistory = Order::getOrdHistory($id);
        dd($order);
        return view(
            'admin_order_show',
            compact(
                'order',
                'allProds',
                'ordHistory'
            )
        );

    }
}
