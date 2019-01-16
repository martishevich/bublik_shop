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
	
	public function edit(Request $request, $id)
	{
		$allCat = Categories::orderBy('position')
			->get();
		$prod   = Product::find($id);
		return view('admin.admin_prod_edit', compact('allCat', 'prod'));
	}
	
	public function save(ProductValidation $request, $id = false)
	{
		/*todo переделать на проверку (есть ли товар с таким id в базе +софтделете) если есть то обновить, если нет до добавить. Переделать, что создание картинки будет только если в запросе есть картинка*/
		$referer = $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
		switch ($referer){
			case $_SERVER['SERVER_NAME'] . '/home/products/create':
				$id = Product::insertDB($request);
				(new ImageProducts($request, $id))->createImages();
				return redirect('home/products/create')->with('is_add', 'true');
			case $_SERVER['SERVER_NAME'] . "/home/products/edit/$id":
				Product::updateDB($request, $id);
				(new ImageProducts($request, $id))->createImages();
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