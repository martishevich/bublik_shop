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
        //Delete Cart

        if (isset($_POST['remove'])){
            $removeId = $_POST['id'];
            $request->session()->forget('cart.'.$removeId);
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

            //Validation 

            if (isset($_POST['Send'])){
                $validatedData = $request->validate([
                    'fullname' => 'required|max:60',
                    'phonenumber' => 'required|max:60',
                    'email' => 'required|email',
                    'adress' => 'required|max:60',
                    'comment' => ''
               ]);

               $post=$_POST;

               $post = array_except($post, ['_token']);

               foreach ($post as $k => $v){
                $post[$k] = trim($v); 
               }

                //Send Validate Data

               if ($post = $validatedData) {
                   foreach ($post as $k => $v){
                    $post[$k] = e($v);
                   } 
                return view('vallidate', ['post' => $post]);
                }

                else{
                    return view('Cardshop', ['post' => $post, 'orderItems' => $orderItems, '']);
                }
               
            }
            return view('Cardshop', compact('orderItems'));
        }
        return view('Cardshop');
    }

    
        
}
