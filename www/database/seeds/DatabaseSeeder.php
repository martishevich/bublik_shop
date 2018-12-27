<?php
	
	use Illuminate\Database\Seeder;
	
	class DatabaseSeeder extends Seeder
	{
		public function run()
		{
			$this->call('StatusesTableSeeder');
			$this->call('CategoriesTableSeeder');
			$this->call('ProductsTableSeeder');
			$this->call('OrdersTableSeeder');
			$this->call('OrderProductsTableSeeder');
			$this->call('OrderDataTableSeeder');
			$this->call('OrderStatusesTableSeeder');
            $this->call('UsersTableSeeder');
		}
	}
