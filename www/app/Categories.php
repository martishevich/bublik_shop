<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Categories extends Model
{
    protected $table = 'categories';

    public static function GetCategories($id){
        return DB::table('products')->where('category_id',$id)->paginate(10);
    }
}
