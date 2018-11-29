<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VallidateController extends Controller
{
    public function vallidate(Request $request){
        $validatedData = $request->validate([
            'FullName' => 'required|max:60|alpha_dash',
            'PhoneNumber' => 'required|digits:12',
            'Email' => 'required|email',
            'Adress' => 'required|alpha_dash',
            'comment' => 'required|alpha_dash'
       ]);
       
       return view('vallidate', compact('validatedData'));
    }
}
