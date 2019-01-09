<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PaymentController extends Controller
{
    public function callBank(Request $request)
    {

        return response()->json(
            ['error' => 'You can only edit your own books.' . $request->post('ggg')],
            200
        );
    }
}