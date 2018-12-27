<?php

use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->delete();
	    factory(App\Product::class, 3000)->create();
        /*DB::table('products')->delete();
        DB::table('products')->insert([
            'category_id' => '1',
            'name'        => 'Notebook Asus',
            'description' => 'Very good laptop for work and game. If you want the best computer for yor child this good choice',
            'short_disc'  => 'Very good laptop',
            'price'       => '500.20',
            'is_active'   => '1'
        ]);

        DB::table('products')->insert([
            'category_id' => '1',
            'name'        => 'Notebook Apple',
            'description' => 'Good choice if you have mach money and like to stand out',
            'short_disc'  => 'Not bad...',
            'price'       => '1500.50',
            'is_active'   => '0'
        ]);*/
    }
}
