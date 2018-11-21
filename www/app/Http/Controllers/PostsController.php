<?php

namespace App\Http\Controllers;

use App\Categories;
use Illuminate\Http\Request;
use App\Http\Controllers;
use App\Providers;

class PostsController extends Controller
{
    public function index(){
        $catTitle = Categories::orderBy('position')
            ->get();
        return view('posts.index', compact('catTitle'));
    }
}
