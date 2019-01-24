<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;
use App\Components\FileManagers\ImageManager;

class Product extends Model
{
    use SoftDeletes;
    
    protected $dates = ['deleted_at'];
    public $timestamps = false;
    
    public static function insertDB($request)
    {
        $id = DB::table('products')->insertGetId(
            [
            'category_id' => trim(preg_replace("~  +~", " ", $request->input('category_id'))),
            'name'        => trim(preg_replace("~  +~", " ", $request->input('name'))),
            'description' => trim(preg_replace("~  +~", " ", $request->input('description'))),
            'short_disc'  => trim(preg_replace("~  +~", " ", $request->input('short_disc'))),
            'price'       => trim(preg_replace("~  +~", " ", $request->input('price'))),
            'is_active'   => trim(preg_replace("~  +~", " ", $request->input('is_active'))),
            ]
        );
        return $id;
    }
    
    public static function updateDB($request, $id)
    {
        Product::where('id', $id)
            ->update(
                [
                'category_id' => trim(preg_replace("~  +~", " ", $request->input('category_id'))),
                'name'        => trim(preg_replace("~  +~", " ", $request->input('name'))),
                'description' => trim(preg_replace("~  +~", " ", $request->input('description'))),
                'short_disc'  => trim(preg_replace("~  +~", " ", $request->input('short_disc'))),
                'price'       => trim(preg_replace("~  +~", " ", $request->input('price'))),
                'is_active'   => trim(preg_replace("~  +~", " ", $request->input('is_active')))
                ]
            );
        return $id;
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
    
    public function orderProducts()
    {
        return $this->hasMany('App\OrderProd');
    }

    public static function getLastId()
    {
        return Product::query()
            ->selectRaw('max(id) as max')
            ->from('products')
            ->get();
    }
}