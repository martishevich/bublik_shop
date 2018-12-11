<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;

class VallidateController extends Controller
{
    public function vallidate(Request $request){
        
        $validatedData = $request->validate([
            'fullname' => 'required|max:60|alpha_dash',
            'phonenumber' => 'required|digits:12',
            'email' => 'required|email',
            'adress' => 'required|alpha_dash',
            'comment' => 'required|alpha_dash'
       ]);
      
        dump($validatedData);
        dump($_POST);
        $post=$_POST;
        dump($post);
        $post = array_except($post, ['_token']);
        dump($post);
        if ($post = $validatedData) {
            echo '3';
            return view('Cardshop', compact('request'));
        }
        else {
            return view('vallidate', compact('validatedData'));
        }
    }
}
