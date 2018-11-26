<?php

namespace App\Http\Controllers;

use App\Categories;
use Illuminate\Http\Request;
use App\Http\Controllers;
use App\Providers;
use DB;

class PostsController extends Controller
{
    public function index(){
        $catTitle = Categories::orderBy('position')
            ->get();
        $product = DB::table('products')->get();    
        return view('posts.index', ['catTitle'=>$catTitle, 'product'=>$product]);
    }
}
