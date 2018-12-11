<?php

namespace App\Http\Controllers;

use App\Categories;
use App\Product;
use Dotenv\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\ProductValidation;

class AdminProductController extends Controller
{

    public function index()
    {
        $allProd = Product::all();
        return view('admin_prod', compact('allProd'));
    }

    public function create()
    {
        $is_add = session('is_add');
        $allCat = Categories::orderBy('position')
            ->get();
        return view('admin_prod_create', compact('allCat', 'is_add'));
    }

    public function save(ProductValidation $request, $id)
    {
        $referer = $request->headers->get('referer');
        switch ($referer) {
            case 'http://localhost/home/products/create':
                Product::insertDB($request);
                return redirect('home/products/create')->with('is_add', 'true');
            case "http://localhost/home/products/edit/$id":
                Product::updateDB($request, $id);
                return redirect('home/products')->with('is_edit', 'true');
            default:
                return redirect('home/products/create')->with('is_add', 'false');
        }
    }

    public function edit(Request $request, $id)
    {
        $allCat = Categories::orderBy('position')
            ->get();
        $prod   = Product::find($id);
        return view('admin_prod_edit', compact('allCat', 'prod'));
    }

    public function destroy($id)
    {
        Product::delDB($id);
        return redirect('home/products')->with('is_del', 'true');
    }
}