<?php

use Illuminate\Database\Seeder;

class StatusesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('status_orders')->delete();
        DB::table('status_orders')->insert([
            'title' => 'processing'
        ]);
        DB::table('status_orders')->insert([
            'title' => 'rebuild'
        ]);
        DB::table('status_orders')->insert([
            'title' => 'boxing'
        ]);
        DB::table('status_orders')->insert([
            'title' => 'collected'
        ]);
        DB::table('status_orders')->insert([
            'title' => 'waiting for delivering'
        ]);
        DB::table('status_orders')->insert([
            'title' => 'delivering'
        ]);
        DB::table('status_orders')->insert([
            'title' => 'delivered'
        ]);
        DB::table('status_orders')->insert([
            'title' => 'cancel'
        ]);


        DB::table('status_payments')->delete();
        DB::table('status_payments')->insert([
            'title' => 'waiting for payment'
        ]);
        DB::table('status_payments')->insert([
            'title' => 'cash'
        ]);
        DB::table('status_payments')->insert([
            'title' => 'bank roga'
        ]);
        DB::table('status_payments')->insert([
            'title' => 'refund'
        ]);
    }
}
