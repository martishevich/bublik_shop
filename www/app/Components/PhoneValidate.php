<?php
/**
 * Created by PhpStorm.
 * User: xeon
 * Date: 13.12.18
 * Time: 12:29
 */

namespace App\Components;


class PhoneValidate
{
    public static function FilterPhone($phone)
    {
        $numbers = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];
        $phone = str_split($phone);
        $new_phone = '';
        foreach ($phone as $val){
            if (in_array($val, $numbers)){
                $new_phone .=$val;
            }
        }

        if(strlen($new_phone)==12){
            $new_phone = substr($new_phone, 3, 9);
        }
        if(strlen($new_phone)==13){
            $new_phone = substr($new_phone, 4, 9);
        }
        if(strlen($new_phone)==11){
            $new_phone = substr($new_phone, 2, 9);
        }

        return '375'.$new_phone;
    }
}