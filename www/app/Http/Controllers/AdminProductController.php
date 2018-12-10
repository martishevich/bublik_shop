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
	
	public function save(ProductValidation $request)
	{
		Product::insertDB($request);
		return redirect('home/products/create')->with('is_add', 'true');
	}
	
	public function edit(Request $request, $id)
	{
		
		if (isset($_POST['category_id']) && isset($_POST['name']) && isset($_POST['submit'])){
			Product::updateDB($request, $id);
			return redirect('home/products')->with('is_edit', 'true');
		}
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
