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
            $counter = count($request->session()->get('cart', '0'));
            $request->session()->put('counter', $counter);
        }
        
        //Update Cart

        if (isset($_POST['Update'])){
            foreach(session('cart') as $k => $v ){
                if ($_POST['quantity'.$k] > 0){
                    $request->session()->put('cart.'.$k, $_POST['quantity'.$k]);
                }
                else {
                    $request->session()->forget('cart.' . $k);
                }
            }
            
        }
        
        //Add Product Count to Order Items
        
        $sessionCart = $request->session()->get('cart');
        
        if (isset($sessionCart)) 
        {
            
            $orderItems = Product::prod_sess(array_keys($sessionCart));

            foreach ($orderItems as $key => $v) 
            {
                $orderItems[$key]['count'] = $sessionCart[$v['id']];
            } 
            
            //Validation 
            
            if (isset($_POST['Send']))
            {
                
                $post=$_POST;
                
                $validator = Validator::make($request->all(), [
                    'fullname'    => 'required|max:60',
                    'phonenumber' => 'required',
                    'email'       => 'required|email',
                    'adress'      => 'required',
                    'comment'     => 'max:5000'
                  ]);
              
                  if ($validator->fails()) {
                    return view('Cardshop', ['post' => $post, 'orderItems' => $orderItems]) 
                               ->withErrors($validator); 
                  }
                
                $post          = array_except($post, ['_token']);
                
                if ($validator->passes()) 
                {
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

                    foreach ($orderItems as $key => $m) 
                    {
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
                    return view('/add_success', ['s' => $s, 'post' => $post, 'orderItems' => $orderItems]);
                }
                return view('Cardshop', ['post' => $post, 'orderItems' => $orderItems]); 
            }
            
            return view('Cardshop', ['orderItems' => $orderItems]);
        }
        return view('Cardshop');
    }


}
