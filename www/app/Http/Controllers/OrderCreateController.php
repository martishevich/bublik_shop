<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use DB;
use App\Http\Controllers;
use mysql_xdevapi\Session;
use Validator;

class OrderCreateController extends Controller
{

    public function cardshop(Request $request)
    {
        //REMOVE CART
        if (isset($_POST['remove'])) {
            $removeId = $_POST['id'];
            $request->session()->forget('cart.' . $removeId);
            //unset($_POST['Update']);
            $counter = count($request->session()->get('cart', '0'));
            $request->session()->put('counter', $counter);
        }


        //Update Cart

        if (isset($_POST['Update'])) {
            foreach(session('cart') as $k => $v ){
                $inputNumber = $_POST['quantity'.$k];
                $validator = Validator::make($request->all(), ['quantity'.$k => 'digits_between:1,1000']);
                if ($validator->fails()) {$inputNumber = $request->session()->get('cart.'.$k);
                };
                if ($validator->passes()) {$inputNumber = $_POST['quantity'.$k];
                };
                if ($inputNumber > 0) { 
                    $request->session()->put('cart.'.$k, $inputNumber);
                }
                /*else {
                    $request->session()->forget('cart.' . $k);
                    $counter = count($request->session()->get('cart', '0'));
                    $request->session()->put('counter', $counter);
                }*/

            }
        }

        //Add Product Count to Order Items

        $sessionCart = $request->session()->get('cart');

        if (isset($sessionCart)) {
            $orderItems = Product::prod_sess(array_keys($sessionCart));

            foreach ($orderItems as $key => $v) {
                $orderItems[$key]['count'] = $sessionCart[$v['id']];
            }

            //Validation 

            if (isset($_POST['Send'])) {

                $post = $_POST;

                $validator = Validator::make(
                    $request->all(), [
                    'fullname'    => 'required|max:80',
                    'phonenumber' => 'required|regex:/[()"+"-"0-9]/',
                    'email'       => 'required|email|max:150',
                    'adress'      => 'required|max:150',
                    'comment'     => 'max:250'
                    ]
                );
              
                if ($validator->fails()) {
                    return view('Cardshop', ['post' => $post, 'orderItems' => $orderItems]) 
                             ->withErrors($validator); 
                }
                
                $post          = array_except($post, ['_token']);
                
                if ($validator->passes()) {
                    foreach ($post as $k => $v) 
                    {
                        $post[$k] = e(trim($v));
                    }
                    $dataor['fullname']  = $post['fullname'];
                    $dataor['telephone'] = $post['phonenumber'];
                    $dataor['email']     = $post['email'];
                    $dataor['address']   = $post['adress'];

                    $s['order_id']   = DB::table('orders')->insertGetId($dataor);
                    $s['payment_id'] = 1;
                    $s['status_id']  = 1;
                    $s['comment']    = '';
                    DB::table('order_statuses')->insert($s);

                    foreach ($orderItems as $key => $m) {
                        $orderItems[$key]['order_id'] = $s['order_id'];
                        $order_prod['order_id']       = $s['order_id'];
                        $order_prod['product_id']     = $m['id'];
                        $order_prod['quantity']       = $m['count'];
                        $order_prod['price']          = $m['price'];

                        DB::table('order_prods')->insert($order_prod);
                    }
                    $dataOrder['order_id'] = $s['order_id'];
                    $dataOrder['key']      = 'comment';
                    $dataOrder['value']    = $post['comment'];
                    $dataOrder['group']    = 'time';
                    DB::table('order_datas')->insert($dataOrder);
                    return view('/preOrder', ['s' => $s, 'post' => $post, 'orderItems' => $orderItems]);
                }
                return view('Cardshop', ['post' => $post, 'orderItems' => $orderItems]);
            }

            return view('Cardshop', ['orderItems' => $orderItems]);
        }
        return view('Cardshop');
    }

    public function SendView()
    {

    }

}
