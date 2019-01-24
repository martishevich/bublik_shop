<?php

namespace App\Http\Controllers;

use App\Order;
use PDF;
use Mail;
use Illuminate\Http\Request;
use DB;

class AddToOrderController extends Controller
{
    public function clearSession(Request $request)
    {
        $request->session()->forget('cart');
    }

    public function viewOrder(Request $request)
    {
        $request->session()->forget(['counter','cart']);

        if (isset($_POST['goback'])) {
            return redirect('Cardshop');
        }
        $id    = $_POST['id'];
        $order = Order::getById($id);
        $data  = Order::getProds($id)->toArray();
        $pdf   = PDF::loadView('orderList', compact('data', 'order'))->setPaper('a4');
        Mail::send(
            'backEmail', ['order' => $order], function ($message) use ($pdf, $order) {
                $message->from('loliabombita@mail.ru', 'Bublic Shop');
                $message->to($order->email)->subject('Invoice');
                $message->attachData($pdf->output(), "orderList.pdf");
            }
        );
        return view('add_success', ['order'=>$order]);
    }
}

