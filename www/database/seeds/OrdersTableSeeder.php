<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrdersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('orders')->delete();
        DB::table('orders')->insert([
            'fullname'   => 'Стив Джобс',
            'telephone'  => '+375297090660',
            'email'      => 'smile@gmail.com',
            'address'    => 'г. Минск, ул. Кульман, 11',
        ]);
    }
}
