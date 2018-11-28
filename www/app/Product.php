<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Product extends Model
{
    public function orderProd(){
        return $this->hasMany('App\OrderProd');
    }

	public static function insertDB($request){
		DB::table('products')->insert([
			'category_id' => trim(htmlentities(preg_replace("~  +~"," ",$request->input('category_id')))),
			'name' => trim(htmlentities(preg_replace("~  +~"," ",$request->input('name')))),
			'description' => trim(htmlentities(preg_replace("~  +~"," ",$request->input('description')))),
			'short_disc' => trim(htmlentities(preg_replace("~  +~"," ",$request->input('short_disc')))),
			'price' => trim(htmlentities(preg_replace("~  +~"," ",$request->input('price')))),
			'is_active' => trim(htmlentities(preg_replace("~  +~"," ",$request->input('is_active')))),
		]);
	}

    public static function updateDB($request, $id){
        Product::where('id', $id)
            ->update([
                'category_id' => trim(htmlentities(preg_replace("~  +~"," ",$request->input('category_id')))),
                'name' => trim(htmlentities(preg_replace("~  +~"," ",$request->input('name')))),
                'description' => trim(htmlentities(preg_replace("~  +~"," ",$request->input('description')))),
                'short_disc' => trim(htmlentities(preg_replace("~  +~"," ",$request->input('short_disc')))),
                'price' => trim(htmlentities(preg_replace("~  +~"," ",$request->input('price')))),
                'is_active' => trim(htmlentities(preg_replace("~  +~"," ",$request->input('is_active'))))
            ]);
    }

    public static function delDB($id){
        Product::where('id', $id)->delete();
    }
}