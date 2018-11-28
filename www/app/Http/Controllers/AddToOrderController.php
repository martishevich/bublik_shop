<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use DB;

class AddToOrderController extends Controller
{
    public function add(Request $request)
    {
        $sessionCart = $request->session()->get('cart');
        if (isset($sessionCart)) {
            $orderItems = Product::prod_sess(array_keys($sessionCart));
            foreach ($orderItems as $key => $v) {
                $orderItems[$key]['count'] = $sessionCart[$v['id']];
            }
        }
        $validatedata = $request->validate([
            'FName'   => 'required',
            'email'   => 'required',
            'PNumber' => 'required',
            'Address' => 'required',
            'comment' => 'required'
        ]);
        dd($validatedata);
        DB::table('orders')->insert($validatedata);
        dd('asd');
        return view('add_success');

    }
}