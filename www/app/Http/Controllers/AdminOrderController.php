<?php

namespace App\Http\Controllers;

use App\Order;

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
		return view('admin_order_show', compact('order'));
	}
	
	public function change($id)
	{
		$order = Order::getById($id)->checkAndSetStatus($_GET);
		return redirect("home/orders/$id");
	}
	
	public function sendOrderList($id){
		$order = Order::getById($id)->sendMail();
		return redirect("/home/orders/$id");
	}
	/*$start = microtime(true);
	$finish = number_format(microtime(true) - $start, 2, ',', ' ');
	dd($finish);*/
}
