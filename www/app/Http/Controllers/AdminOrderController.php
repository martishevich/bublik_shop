<?php

namespace App\Http\Controllers;

use App\Components\Filters\OrdersFilter;
use App\Components\Filters\QueryFilter;
use App\Order;
use Illuminate\Http\Request;

class AdminOrderController extends Controller
{
	public function index(Request $request)
	{
		$request->flash();
		$orders = Order::filterAndPagination($request);
		return view('admin_order', compact('orders'));
	}
	
	public function show($id)
	{
		$order = Order::getById($id);
		return view('admin_order_show', compact('order'));
	}
	
	public function change($id)
	{
		$order = Order::getById($id)->checkAndSetStatus($_GET);
		return redirect("home/orders/$id");
	}
	
	public function sendOrderList($id)
	{
		$order = Order::getById($id)->sendMail();
		return redirect("/home/orders/$id");
	}
	/*$start = microtime(true);
	$finish = number_format(microtime(true) - $start, 2, ',', ' ');
	dd($finish);*/
}
