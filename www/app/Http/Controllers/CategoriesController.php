<?php

namespace App\Http\Controllers;

use App\Categories;


class CategoriesController extends Controller
{
    public function ShowCategories($id)
    {
        $catTitle = Categories::orderBy('position')
            ->get();
        $categories = Categories::GetCategories($id);
        return view('categories',['catTitle' => $catTitle, 'categories' => $categories,'id' => $id]);
    }
}
