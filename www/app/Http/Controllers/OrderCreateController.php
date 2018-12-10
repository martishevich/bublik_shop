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
        $data = $request->session()->all();
        if (isset($_POST['remove'])) {
            $removeId = $_POST['id'];

            $request->session()->forget('cart.' . $removeId);
        }

        //Update Cart

        if (isset($_POST['quantity'])){

            if ($_POST['quantity'] > 0){

            $removeId = $_POST['upid'];
            $request->session()->put('cart.'.$removeId, $_POST['quantity']);

            }
        }
    
        //Add Product Count to Order Items

        $sessionCart = $request->session()->get('cart');

        if (isset($sessionCart)) {
            $orderItems = Product::prod_sess(array_keys($sessionCart));

            foreach ($orderItems as $key => $v) {
                $orderItems[$key]['count'] = $sessionCart[$v['id']];
            }
            if (isset($_POST['Send'])) {
                $validatedData = $request->validate([
                    'fullname'    => 'required|max:60|alpha_dash',
                    'phonenumber' => 'required|digits:12',
                    'email'       => 'required|email',
                    'adress'      => 'required|alpha_dash',
                    'comment'     => 'required|alpha_dash'
                ]);
                $post          = $_POST;
                $post          = array_except($post, ['_token']);
                if ($post = $validatedData) {
                    foreach ($post as $k => $v) {
                        $post[$k] = trim($v);
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
                    $dataOrder['value']    = '';
                    $dataOrder['group']    = 'time';
                    DB::table('order_datas')->insert($dataOrder);
                    return view('add_success', compact('s'));
                } else {
                    $gopost = trim($post);
                    return view('Cardshop', ['post' => $post, 'orderItems' => $orderItems, '']);
                }

            }
            return view('Cardshop', compact('orderItems'));
        }
        return view('Cardshop', compact('error'));
    }


}
