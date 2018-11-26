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
    	$is_add = false;
    	if (isset($_POST['category_id']) && isset($_POST['name'])){
    		Product::insertDB($request);
		    $is_add = true;
	    }
    	$request->flash();
	    $allCat = Categories::orderBy('position')
		    ->get();
        return view('admin_prod_create', compact('allCat', 'is_add'));
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
