<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use function GuzzleHttp\Promise\all;
use Session;
use App\Categories;
use App\Http\Controllers;
use App\Providers;
use Validator;

class ProductDetailsController extends Controller
{
    public function productdetails($id)
    {
        $product  = DB::table('products')->get();
        $productdetails[$id] = (array) $product[$id-1];
        $prodDet = $productdetails[$id];
        $product = Product::getByIds($id);
        $quantity = 1;
        if (isset($_POST['ADD'])) {
            $validator = Validator::make($_POST, ['quantity' => 'digits_between:1,100']);
            if ($validator->fails()) {
                $quantity = 1;
            }
            if ($validator->passes()) {
                $quantity = $_POST['quantity'];
                $count = session()->get('cart.' . $product->getKey(), 0);
                session()->put(
                    'cart.' . $product->getKey(),
                    $count + $quantity
                );
            };
            $counter = count(session()->get('cart', '0'));
            session()->put('counter', $counter);
        };
        return view("product_details", ['prodDet' => $prodDet, 'id' => $id, 'quantity' => $quantity]);
    }
}