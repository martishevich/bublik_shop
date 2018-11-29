<?php

namespace App\Http\Controllers;

use App\Categories;
use App\Product;
use Illuminate\Http\Request;
use App\Http\Controllers;
use App\Providers;
use mysql_xdevapi\Session;
use DB;

class PostsController extends Controller
{
    public function index(Request $request)
    {
        $product = Product::getByIds(
            $request->post('prodid', 0)
        );

        if ($product instanceof Product) {

            $count = $request->session()->get('cart.' . $product->getKey(), 0);
            $request->session()->put(
                'cart.' . $product->getKey(),
                $count + 1
            );
        }
        $request->session()->save();
        var_dump($request->session()->all());
        $catTitle = Categories::orderBy('position')
            ->get();
        $product  = DB::table('products')->get();

        return view('posts.index', ['catTitle' => $catTitle, 'product' => $product]);
    }
}
