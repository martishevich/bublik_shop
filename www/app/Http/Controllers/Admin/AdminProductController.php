<?php

namespace App\Http\Controllers\Admin;

use App\Components\FileManagers\ImageProducts;
use App\Http\Controllers\Controller;
use App\Categories;
use App\Product;
use App\Http\Requests\ProductValidation;

class AdminProductController extends Controller
{



    public function index()
    {
        $allProd = Product::orderBy('id', 'DESK')->paginate(50);
        return view('admin.admin_prod', compact('allProd'));
    }

    public function create()
    {
        $is_add = session('is_add');
        $allCat = Categories::orderBy('position')
            ->get();
        return view('admin.admin_prod_create', compact('allCat', 'is_add'));
    }

    public function edit($id)
    {
        $allCat = Categories::orderBy('position')
            ->get();
        $prod   = Product::find($id);
        return view('admin.admin_prod_edit', compact('allCat', 'prod'));
    }

    public function create_save(ProductValidation $request)
    {
        $id = Product::insertDB($request);
        if($request->has('image')) {
            (new ImageProducts($request, $id))->createImages();
        }
        return redirect('home/products/create')->with('is_add', 'true');
    }

    public function edit_save(ProductValidation $request, $id = false)
    {
        Product::updateDB($request, $id);
        if($request->has('image')) {
            (new ImageProducts($request, $id))->createImages();
        }
        return redirect('home/products')->with('is_edit', 'true');
    }

    public function destroy($id)
    {
        Product::delDB($id);
        return redirect('home/products')->with('is_del', 'true');
    }
}