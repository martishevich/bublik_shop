<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrderProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('order_prods')->delete();
        DB::table('order_prods')->insert([
            'order_id'   => '1',
            'product_id' => '1',
            'quantity'   => '2',
            'price'      => '500.20'
        ]);

        DB::table('order_prods')->insert([
            'order_id'   => '1',
            'product_id' => '2',
            'quantity'   => '3',
            'price'      => '1500.50'
        ]);
    }
}
