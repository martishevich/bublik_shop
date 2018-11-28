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
            $orderItems = Product::prod_sess(array_keys($sessionCart));
            foreach ($orderItems as $key => $v) {
                $orderItems[$key]['count'] = $sessionCart[$v['id']];
                if (isset($_POST['quantity'])){
                    $prnumber = $_POST['quantity'];
                    echo $prnumber;
                }
                else {
                    $prnumber = $orderItems[$key]['count'];
                }
            }
            
            return view('Cardshop', ['orderItems' => $orderItems,'prnumber'=> $prnumber]);
        }
        return view('Cardshop');
    }
}
