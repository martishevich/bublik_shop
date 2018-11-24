<?php

namespace App\Http\Controllers;

use App\Categories;
use App\Product;
use Illuminate\Http\Request;

class AdminProductController extends Controller
{

    public function index()
    {
    	$allProd = Product::all();
        return view('admin_prod', compact('allProd'));
    }

    public function create(Request $request)
    {
	    $allCat = Categories::orderBy('position')
		    ->get();
        return view('admin_prod_create', compact('allCat'));
    }

    public function edit($id)
    {
	    $allCat = Categories::orderBy('position')
		    ->get();
	    return view('admin_prod_edit', compact('allCat'));
    }

    public function destroy($id)
    {
        echo __METHOD__;
    }
}
