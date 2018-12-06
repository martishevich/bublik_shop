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
                    //return view('/show', ['post' => $post,'orderItems' => $orderItems]);
                    return redirect()->action('AddToOrderController@add')->with($orderItems, $post);
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
