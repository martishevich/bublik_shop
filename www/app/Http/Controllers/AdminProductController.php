<?php

namespace App\Http\Controllers;

use App\Categories;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminProductController extends Controller
{

    public function index()
    {
        $allProd = Product::all();
        return view('admin_prod', compact('allProd'));
    }

    public function create(Request $request)
    {
        $is_add = false;
        if (isset($_POST['category_id']) && isset($_POST['name']) && isset($_POST['submit'])) {
            Product::insertDB($request);
            $is_add = true;
        }
        $request->flash();
        $allCat = Categories::orderBy('position')
            ->get();
        return view('admin_prod_create', compact('allCat', 'is_add'));
    }

    public function edit(Request $request, $id)
    {
        if (isset($_POST['category_id']) && isset($_POST['name']) && isset($_POST['submit'])) {
            Product::updateDB($request, $id);
            return redirect('home/products')->with('is_edit', 'true');
        }
        $allCat = Categories::orderBy('position')
            ->get();
        $prod = Product::find($id);
        return view('admin_prod_edit', compact('allCat', 'prod'));

    }

    public function destroy($id)
    {
        Product::delDB($id);
        return redirect('home/products')->with('is_del', 'true');
    }

}
