<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class AdminOrderController extends Controller
{
    public function index(){
        $allOrd = Product::all();
        return view('admin_order', compact('allOrd'));
    }
}
