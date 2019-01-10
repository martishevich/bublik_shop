<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Categories;
use App\Product;
use Illuminate\Http\Request;
use App\Http\Requests\ProductValidation;
use App\Components\FileManagers\ImageManager;

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
	
	public function edit(Request $request, $id)
	{
		$allCat = Categories::orderBy('position')
			->get();
		$prod   = Product::find($id);
		return view('admin.admin_prod_edit', compact('allCat', 'prod'));
	}
	
	public function save(ProductValidation $request, $id = false)
	{
		$referer = $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
		switch ($referer){
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
	
	public function destroy($id)
	{
		Product::delDB($id);
		return redirect('home/products')->with('is_del', 'true');
	}
}