<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;

class VallidateController extends Controller
{
    public function vallidate(Request $request){
        $this->validate($request, [
            'category_id' => 'required',
            'name'        => 'required',
            'price'       => 'required',
            'description' => 'required',
            'short_disc'  => 'required'

        ]);
            return view('admin_prod.create');
        
    }
}
