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

        DB::table('products')->insert([
            'title' => 'Notebooks',
            'description' => 'Ноутбуки',
            'position' => '5',
        ]);
    }
}
