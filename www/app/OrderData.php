<?php
	
	namespace App;
	
	use Illuminate\Database\Eloquent\Model;
	
	class OrderData extends Model
	{
		/**
		 * @param Order $order
		 * @return \Illuminate\Database\Eloquent\Collection
		 */
		public static function getListByOrder(Order $order): \Illuminate\Database\Eloquent\Collection
		{
			return static::query()
				->where([
					'order_id' => $order->getKey()
				])
				->get();
		}
		
		public function order()
		{
			return $this->belongsTo('App\Order');
		}
		
		public function getName()
		{
			switch ($this->key){
				case 'comment':
					return 'Comment';
			}
		}
	}
