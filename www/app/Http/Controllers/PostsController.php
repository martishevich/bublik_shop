<?php

namespace App\Http\Controllers;

use App\Categories;
use Illuminate\Http\Request;
use App\Http\Controllers;
use App\Providers;
use mysql_xdevapi\Session;
use DB;

class PostsController extends Controller
{
    public function index(Request $request){

        $id = $request['id'];
        $value = $request->session()->get('cart.'.$id, 0);
        $request->session()->put('cart.'.$id, $value+1);

        $catTitle = Categories::orderBy('position')
            ->get();
        $product = DB::table('products')->get();
        dump($product);
        dump($_POST);   
        return view('posts.index', ['catTitle'=>$catTitle, 'product'=>$product]);
    }
}
