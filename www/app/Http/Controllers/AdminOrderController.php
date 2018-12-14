<?php

namespace App\Http\Controllers;

use App\Order;
use App\OrderProd;
use App\OrderStatus;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
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
		if ($_GET['status'] == 'boxing' && $order->canBoxing()){
			$order->setBoxing();
		}
		if ($_GET['status'] == 'collected' && $order->canCollected()){
			$order->setCollected();
		}
		if ($_GET['status'] == 'waiting' && $order->canWaiting()){
			$order->setWaiting();
		}
		if ($_GET['status'] == 'delivering' && $order->canDelivering()){
			$order->setDelivering();
		}
		if ($_GET['status'] == 'delivered' && $order->canDelivered()){
			$order->setDelivered();
		}
		if ($_GET['status'] == 'cancel' && $order->canCancel()){
			$order->setCancel();
		}
		if ($_GET['status'] == 'paid' && $order->canPaid()){
			$order->setPaid();
		}
		return redirect("home/orders/$id");
	}
	
	public function sendOrderList($id){
		$order = Order::getById($id);
		$order->sendMail();
		return redirect("/home/orders/$id");
	}
	/*$start = microtime(true);
	$finish = number_format(microtime(true) - $start, 2, ',', ' ');
	dd($finish);*/
}
