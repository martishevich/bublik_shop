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
            'price' => '50000',
            'is_active' => '1'
        ]);

        DB::table('products')->insert([
            'category_id' => '1',
            'name' => 'Notebook Apple',
            'description' => 'Good choice if you have mach money and like to stand out',
            'short_disc' => 'Not bad...',
            'price' => '15000',
            'is_active' => '0'
        ]);


    }
}
