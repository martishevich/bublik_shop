<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PaymentController extends Controller
{
    public function callBank(Request $request)
    {
        $client   = new Client(['base_url' => 'http://localhost']);
        $data     = [
            'form_params' => [
                'name' => 'Slavik',
                'tag'  => 'tapok'
            ]
        ];
        $responce = $client->request(
            'POST',
            'http://localhost/payment',
            $data
        );
        echo $responce->getBody();
        //        return response()->json(
        //            ['error' => 'You can only edit your own books.' . $request->post('ggg')],
        //            200
        //
        //        );

    }
}