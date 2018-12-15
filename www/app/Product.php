<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Product extends Model
{
    public $timestamps = false;

    public static function insertDB($request)
    {
        DB::table('products')->insert([
            'category_id' => trim(preg_replace("~  +~", " ", $request->input('category_id'))),
            'name'        => trim(preg_replace("~  +~", " ", $request->input('name'))),
            'description' => trim(preg_replace("~  +~", " ", $request->input('description'))),
            'short_disc'  => trim(preg_replace("~  +~", " ", $request->input('short_disc'))),
            'price'       => trim(preg_replace("~  +~", " ", $request->input('price'))),
            'is_active'   => trim(preg_replace("~  +~", " ", $request->input('is_active'))),
        ]);
    }

    public static function updateDB($request, $id)
    {
        Product::where('id', $id)
            ->update([
                'category_id' => trim(preg_replace("~  +~", " ", $request->input('category_id'))),
                'name'        => trim(preg_replace("~  +~", " ", $request->input('name'))),
                'description' => trim(preg_replace("~  +~", " ", $request->input('description'))),
                'short_disc'  => trim(preg_replace("~  +~", " ", $request->input('short_disc'))),
                'price'       => trim(preg_replace("~  +~", " ", $request->input('price'))),
                'is_active'   => trim(preg_replace("~  +~", " ", $request->input('is_active')))
            ]);
    }

    public static function delDB($id)
    {
        Product::where('id', $id)->delete();
    }

    public static function getByIds($k)
    {
        return static::where('id', (int)$k)->get()->first();
    }

    public static function prod_sess($k)
    {
        return self::whereIn('id', $k)->get()->toArray();
    }
}