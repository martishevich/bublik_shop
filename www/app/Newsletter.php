<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Newsletter extends Model
{
    public function AddEmail($email){
        DB::table('newsletter')->insert('email');
    }
}
