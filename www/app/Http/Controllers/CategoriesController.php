<?php

namespace App\Http\Controllers;

use App\Categories;


class CategoriesController extends Controller
{
    public function ShowCategories($id)
    {
        $categories = Categories::GetCategories($id);
        return view('categories',compact('categories'));
    }
}
