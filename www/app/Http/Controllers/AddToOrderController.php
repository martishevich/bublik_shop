<?php

namespace App\Http\Controllers;

use App\Order;
use PDF;
use Mail;
use Illuminate\Http\Request;
use App\Product;
use DB;
use Carbon\Carbon;

class AddToOrderController extends Controller
{
   /* public function add(Request $request)
    {

        $sessionCart = $request->session()->get('cart');
        if (isset($sessionCart)) {
            $orderItems = Product::prod_sess(array_keys($sessionCart));
            foreach ($orderItems as $key => $v) {
                $orderItems[$key]['count'] = $sessionCart[$v['id']];
            }
        } else {
            $error = 'Вы не добавили товар!';
            return view('Cardshop', compact('error'));
        }
        $data['fullname']  = $request['fullname'];
        $data['telephone'] = $request['PNumber'];
        $data['email']     = $request['Email'];
        $data['address']   = $request['Adress'];


        $s['order_id']   = DB::table('orders')->insertGetId($data);
        $s['payment_id'] = 1;
        $s['status_id']  = 1;
        $s['comment']    = '';
        DB::table('order_statuses')->insert($s);

        foreach ($orderItems as $key => $v) {

            $orderItems[$key]['order_id'] = $s['order_id'];
            $order_prod['order_id']       = $s['order_id'];
            $order_prod['product_id']     = $v['id'];
            $order_prod['quantity']       = $v['count'];
            $order_prod['price']          = $v['price'];

            DB::table('order_prods')->insert($order_prod);
        }
        $dataOrder['order_id'] = $s['order_id'];
        $dataOrder['key']      = 'comment';
        $dataOrder['value']    = '';
        $dataOrder['group']    = 'time';
        DB::table('order_datas')->insert($dataOrder);
        return view('add_success', compact('s'));
    }*/

    public function clearSession(Request $request)
    {
        $request->session()->forget('cart');
    }

    public function viewOrder()
    {
        $id = $_POST['id'];
        $order = Order::getById($id);
        $data  = Order::getProds($id)->toArray();
        $pdf = PDF::loadView('orderList', compact('data', 'order'));
        Mail::send('backEmail', $data, function ($message) use ($pdf) {
            $message->from('loliabombita@mail.ru', 'Bublic Shop');
            $message->to('loliabombita@mail.ru')->subject('Invoice');
            $message->attachData($pdf->output(), "orderList.pdf");
        });
        return view('/');
    }
}

