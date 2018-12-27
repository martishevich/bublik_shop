<?php

use Illuminate\Database\Seeder;

class OrderStatusesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('order_statuses')->delete();
        DB::table('order_statuses')->insert([
            'order_id'   => '1',
            'status_id'  => '1',
            'payment_id' => '1',
            'comment'    => 'комментарий'
        ]);
    }
}
