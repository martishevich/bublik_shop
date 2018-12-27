<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrderDataTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('order_datas')->delete();
        DB::table('order_datas')->insert([
            'order_id' => '1',
            'key'      => 'comment',
            'value'    => 'after 7 oclock',
            'group'    => 'time'
        ]);
    }
}
