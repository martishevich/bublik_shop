<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HeaderController extends Controller
{
    //
    public function basket(Request $request)
    {

        $counter = $request->session()->get('counter');
        echo 'mmmmmmmmmmmmm';
        return (['counter' => $counter]);
    }
}
