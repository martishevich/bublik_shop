<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Categories;
use App\Product;
use App\Http\Requests\ProductValidation;
use Illuminate\Support\Facades\Request;
use Intervention\Image\Facades\Image;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request as Req;



class AdminProductController extends Controller
{

    public function index(Request $request)
    {
        $client = new Client();
        $responce = $client->request(
            'POST',
            'http://localhost/home/products', ['jsjs' => 'try']);
        dd($request);
        $data = json_decode($responce->getBody(), true);
        print_r($data);
        $allProd = Product::orderBy('id', 'DESK')->paginate(50);
//        Image::make('images/Products/prod1.jpg')
//            ->resize(100, 100)
//            ->save('images/Products/bar.jpg', 60);
        return view('admin.admin_prod', compact('allProd'));
    }

    public function create()
    {

        $is_add = session('is_add');
        $allCat = Categories::orderBy('position')
            ->get();
        return view('admin.admin_prod_create', compact('allCat', 'is_add'));
    }

    public function save(ProductValidation $request, $id = false)
    {
        $referer = $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
        switch ($referer) {
            case $_SERVER['SERVER_NAME'] . '/home/products/create':
                Product::insertDB($request);
                return redirect('home/products/create')->with('is_add', 'true');
            case $_SERVER['SERVER_NAME'] . "/home/products/edit/$id":
                Product::updateDB($request, $id);
                return redirect('home/products')->with('is_edit', 'true');
            default:
                return redirect('home/products/create')->with('is_add', 'false');
        }
    }

    public function edit($id)
    {
        $allCat = Categories::orderBy('position')
            ->get();
        $prod   = Product::find($id);
        return view('admin.admin_prod_edit', compact('allCat', 'prod'));
    }

    public function destroy($id)
    {
        Product::delDB($id);
        return redirect('home/products')->with('is_del', 'true');
    }
}