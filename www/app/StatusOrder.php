<?php
	
	namespace App;
	
	use Illuminate\Database\Eloquent\Model;
	
	class StatusOrder extends Model
	{
		const STATUS_PROCESSING     = 1;
		const STATUS_REBUILD        = 2;
		const STATUS_BOXING         = 3;
		const STATUS_COLLECTED      = 4;
		const STATUS_WAIT_FOR_DELIV = 5;
		const STATUS_DELIVERING     = 6;
		const STATUS_DELIVERED      = 7;
		const STATUS_RET_IN_STORE   = 8;
		const STATUS_CANCEL         = 9;
		
		public static function getName(Order $order): ?self
		{
			return static::query()
				->where(['id' => $order->getStatusId()])
				->get()
				->first();
		}
		
		
		public function orderStatus()
		{
			return $this->hasMany('App\OrderStatus');
		}
	}
