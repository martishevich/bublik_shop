<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use DB;
use Carbon\Carbon;

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
        $data['fullname']   = $request['FName'];
        $data['telephone']  = $request['PNumber'];
        $data['email']      = $request['Email'];
        $data['address']    = $request['Adress'];
        $data['created_at'] = Carbon::now();




        $s['order_id'] = DB::table('orders')->insertGetId($data);
        $s['status_id'] = 1;
        $s['created_at'] = Carbon::now();

        DB::table('order_statuses')->insert($s);




        foreach ($orderItems as $key => $v) {

            $orderItems[$key]['order_id'] = $s['order_id'];
            $order_prod['order_id']       = $s['order_id'];
            $order_prod['product_id']     = $v['id'];
            $order_prod['quantity']       = $v['count'];
            $order_prod['price']          = $v['price'];

            DB::table('order_prods')->insert($order_prod);
        }



        var_dump($orderItems);
        return view('add_success');

    }
    public function clearSession(Request $request){

        $request->session()->forget('cart');

    }
}