<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Product extends Model
{
	public static function insertDB($request){
		DB::table('products')->insert([
			'category_id' => trim(strip_tags(preg_replace("~  +~"," ",$request->input('category_id')))),
			'name' => trim(strip_tags(preg_replace("~  +~"," ",$request->input('name')))),
			'description' => trim(strip_tags(preg_replace("~  +~"," ",$request->input('description')))),
			'short_disc' => trim(strip_tags(preg_replace("~  +~"," ",$request->input('short_disc')))),
			'price' => trim(strip_tags(preg_replace("~  +~"," ",$request->input('price')))),
			'is_active' => trim(strip_tags(preg_replace("~  +~"," ",$request->input('is_active')))),
		]);
	}
}
