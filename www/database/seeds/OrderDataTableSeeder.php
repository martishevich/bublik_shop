<?php

use Illuminate\Database\Seeder;

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
