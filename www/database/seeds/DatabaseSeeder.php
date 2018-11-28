<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call('CategoriesTableSeeder');
    }
}

class CategoriesTableSeeder extends Seeder
{
    public function run(){
        DB::table('categories')->delete();

        DB::table('categories')->insert([
            'title' => 'Notebooks',
            'description' => 'Ноутбуки',
            'position' => '5',
        ]);

        DB::table('categories')->insert([
            'title' => 'Processors',
            'description' => 'Процы',
            'position' => '-20',
        ]);

        DB::table('categories')->insert([
            'title' => 'Mouses',
            'description' => 'Мышки',
            'position' => '0',
        ]);

        DB::table('categories')->insert([
            'title' => 'Motherboards',
            'description' => 'Материнки',
            'position' => '-10',
        ]);

        DB::table('categories')->insert([
            'title' => 'Printers',
            'description' => 'Принтеры',
            'position' => '1',
        ]);

	    DB::table('products')->delete();
        DB::table('products')->insert([
            'category_id' => '1',
            'name' => 'Notebook Asus',
            'description' => 'Very good laptop for work and game. If you want the best computer for yor child this good choice',
            'short_disc' => 'Very good laptop',
            'price' => '500.20',
            'is_active' => '1'
        ]);

        DB::table('products')->insert([
            'category_id' => '1',
            'name' => 'Notebook Apple',
            'description' => 'Good choice if you have mach money and like to stand out',
            'short_disc' => 'Not bad...',
            'price' => '1500.50',
            'is_active' => '0'
        ]);

        DB::table('orders')->delete();
        DB::table('orders')->insert([
            'fullname' => 'Стив Джобс',
            'telephone' => '+375297090660',
            'email' => 'smile@gmail.com',
            'address' => 'г. Минск, ул. Кульман, 11'
        ]);

        DB::table('order_prods')->delete();
        DB::table('order_prods')->insert([
            'order_id' => '1',
            'product_id' => '1',
            'quantity' => '2',
            'price' => '500.20'
        ]);

        DB::table('order_prods')->insert([
            'order_id' => '1',
            'product_id' => '2',
            'quantity' => '3',
            'price' => '1500.50'
        ]);

        DB::table('order_datas')->delete();
        DB::table('order_datas')->insert([
            'order_id' => '1',
            'key' => 'comment',
            'value' => 'after 7 oclock',
            'group' => 'time'
        ]);

        DB::table('status_for_orders')->delete();
        DB::table('status_for_orders')->insert([
            'title' => 'waiting for payment'
        ]);
        DB::table('status_for_orders')->insert([
            'title' => 'paid'
        ]);
        DB::table('status_for_orders')->insert([
            'title' => 'abort'
        ]);
        DB::table('status_for_orders')->insert([
            'title' => 'waiting for deliver'
        ]);
        DB::table('status_for_orders')->insert([
            'title' => 'delivered'
        ]);

        DB::table('order_statuses')->delete();
        DB::table('order_statuses')->insert([
            'order_id' => '1',
            'status_id' => '1'
        ]);

    }
}
