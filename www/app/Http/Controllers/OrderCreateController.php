<?php

namespace App\Http\Controllers;

use App\OrderCreate;
use App\Product;
use Illuminate\Http\Request;
use DB;

class OrderCreateController extends Controller
{
    public function cardshop(Request $request)
    {
        $sessionCart = $request->session()->get('cart');
        if (isset($sessionCart)) {
            $orderItems = OrderCreate::prod_sess(array_keys($sessionCart));
            foreach ($orderItems as $key => $v) {
                $orderItems[$key]['count'] = $sessionCart[$v['id']];
            }
            return view('cardshop', compact('orderItems'));
        }
        return view('cardsop');
    }
}
