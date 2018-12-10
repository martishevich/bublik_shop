<?php

namespace App\Http\Controllers;

use App\OrderCreate;
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
        if (isset($_POST['remove'])){
            $removeId = $_POST['id'];
            
            $request->session()->forget('cart.'.$removeId);
        }
        $sessionCart = $request->session()->get('cart');
        
        $data = $request->session()->all();
       
        if (isset($sessionCart)) {
            $orderItems = Product::prod_sess(array_keys($sessionCart));
            
            if (isset($_POST['quantity'])){

            }
            
           
            foreach ($orderItems as $key => $v) {
                    $orderItems[$key]['count'] = $sessionCart[$v['id']];
            }

            if (isset($_POST['quantity'])){
                $key = $_POST['quantityId'];
                $orderItems[$key]['count']=$_POST['quantity'];
            }
            
           
            if (isset($_POST['Send'])){
                $validatedData = $request->validate([
                    'fullname' => 'required|max:60|alpha_dash',
                    'phonenumber' => 'required|digits:12',
                    'email' => 'required|email',
                    'adress' => 'required|alpha_dash',
                    'comment' => 'required|alpha_dash'
               ]);
               $post=$_POST;
               $post = array_except($post, ['_token']);
               if ($post = $validatedData) {
                   foreach ($post as $k => $v){
                    $post[$k] = trim($v);
                   }
                   
                return view('vallidate', ['post' => $post]);
                }
                else{
                    $gopost = trim($post);
                    return view('Cardshop', ['post' => $post, 'orderItems' => $orderItems, '']);
                }
               
            }
            return view('Cardshop', compact('orderItems'));
        }
        return view('Cardshop');
    }

    
        
}
