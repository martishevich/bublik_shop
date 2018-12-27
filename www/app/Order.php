<?php

namespace App;

use Illuminate\Support\Facades\Config;
use Mail;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Components\Filters\OrdersFilter;

class Order extends Model
{
	public function orderProd()
	{
		return $this->hasMany('App\OrderProd');
	}
	
	public function orderData()
	{
		return $this->hasMany('App\OrderData');
	}
	
	public function orderStatus()
	{
		return $this->hasMany('App\OrderStatus');
	}
	
	public function getStatusName()
	{
		return StatusOrder::getNameStatus($this);
	}
	
	public function getPaymentName()
	{
		return StatusPayment::getNamePayment($this);
	}


	public static function getList()
	{
		return static::query()
			->select([
				'o1.*',
				'p1.total',
				'ss1.title_stat',
				'ss1.title_pay',
			])
			->fromRaw('orders AS o1
				LEFT JOIN(SELECT order_id, SUM(price * quantity) AS total
				FROM order_prods GROUP BY order_id) AS p1
				ON  p1.order_id = o1.id
				LEFT JOIN(SELECT s1.order_id, s1.status_id, s1.payment_id, s3.title as title_stat, p2.title as title_pay
				    FROM order_statuses AS s1
				    LEFT JOIN (SELECT MAX(order_statuses.id) AS lastid, order_id
				    FROM order_statuses
				    GROUP BY order_id) s2
				    ON s1.id = s2.lastid
				    LEFT JOIN status_orders s3
				    ON s1.status_id = s3.id
				    LEFT JOIN status_payments p2
				    ON s1.payment_id = p2.id
				    WHERE NOT s2.lastid IS null) ss1
				ON o1.id = ss1.order_id')
			->where('ss1.status_id', '<>', null)
			->orderBy('o1.id', 'DESC');
	}
	
	public static function getOrdHistory($id)
	{
		return static::query()
			->select([
				'so.title AS status',
				'sp.title AS payment',
				'os.comment',
				'os.created_at'
			])
			->fromRaw('order_statuses AS os
				INNER JOIN status_orders AS so
				ON os.status_id = so.id
				INNER JOIN status_payments AS sp
				ON os.payment_id = sp.id')
			->whereRaw('os.order_id = ?', [$id])
			->orderBy('os.id', 'DESC')
			->get();
	}
	
	/**
	 * @param int $id
	 * @return Order|null
	 */
	public static function getById(int $id): ?Model
	{
		return static::query()
			->find($id);
	}
	/**
	 * @param StatusOrder|null $statusOrder
	 * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Query\Builder[]|\Illuminate\Support\Collection
	 */
	/*public static function getListByStatus($id, StatusOrder $statusOrder = null)
	{
		return static::query()
			->select([
				'o1.*',
				'p1.total',
				'ss1.status_id',
				'ss1.title AS delivering'
			])
			->fromRaw('orders AS o1
			LEFT JOIN(
			SELECT order_id, SUM(price * quantity) AS total
FROM order_prods GROUP BY order_id) AS p1
ON  p1.order_id = o1.id
LEFT JOIN(
SELECT s1.order_id, s1.status_id, s3.title
FROM order_statuses AS s1
LEFT JOIN (
	SELECT MAX(order_statuses.id) AS lastid, order_id
		FROM order_statuses
		GROUP BY order_id) s2
	ON s1.id = s2.lastid
  LEFT JOIN status_orders s3
	ON s1.status_id = s3.id
	WHERE NOT s2.lastid IS null) ss1
ON o1.id = ss1.order_id')
			->where('ss1.status_id', '<>', null)
			->where('ss1.payment_id', '<>', null)
			->whereRaw('o1.id = ?', [$id])
			->get();

	}*/

	
	/**
	 * @return \Illuminate\Database\Eloquent\Collection
	 */
	public function getData()
	{
		return OrderData::getListByOrder($this);
	}
	
	public function checkAndSetStatus($massGet)
	{
		if ($massGet['status'] === 'boxing' && $this->canBoxing()){
			$this->setBoxing();
		}
		if ($massGet['status'] === 'collected' && $this->canCollected()){
			$this->setCollected();
		}
		if ($massGet['status'] === 'waiting' && $this->canWaiting()){
			$this->setWaiting();
		}
		if ($massGet['status'] === 'delivering' && $this->canDelivering()){
			$this->setDelivering();
		}
		if ($massGet['status'] === 'delivered' && $this->canDelivered()){
			$this->setDelivered();
		}
		if ($massGet['status'] === 'cancel' && $this->canCancel()){
			$this->setCancel();
		}
		if ($massGet['status'] === 'paid' && $this->canPaid()){
			$this->setPaid();
		}
	}
	
	public function canBoxing()
	{
		switch ($this->getStatusId()){
			case StatusOrder::STATUS_PROCESSING:
			case StatusOrder::STATUS_REBUILD:
				return true;
		}
		return false;
	}
	
	public function getStatusId()
	{
		return $this->getStatus()->status_id;
	}
	
	/**
	 * @return OrderStatus|null
	 */
	public function getStatus()
	{
		return OrderStatus::getLastByOrder($this);
	}
	
	public function setBoxing()
	{
		DB::table('order_statuses')
			->insert(
				[
					'order_id'   => $this->getStatus()->order_id,
					'status_id'  => StatusOrder::STATUS_BOXING,
					'payment_id' => $this->getPayment()->payment_id
				]
			);
	}
	
	public function canCollected()
	{
		switch ($this->getStatusId()){
			case StatusOrder::STATUS_BOXING:
				return true;
		}
		return false;
	}
	
	//Проверить на возможность установки статуса CANCEL

	public function setCollected()
	{
		DB::table('order_statuses')
			->insert(
				[
					'order_id'   => $this->getStatus()->order_id,
					'status_id'  => StatusOrder::STATUS_COLLECTED,
					'payment_id' => $this->getPayment()->payment_id
				]
			);
	}
	
	public function canWaiting()
	{
		switch ($this->getStatusId()){
			case StatusOrder::STATUS_COLLECTED:
				return true;
		}
		return false;
	}
	
	public function setWaiting()
	{
		DB::table('order_statuses')
			->insert(
				[
					'order_id'   => $this->getStatus()->order_id,
					'status_id'  => StatusOrder::STATUS_WAIT_FOR_DELIV,
					'payment_id' => $this->getPayment()->payment_id
				]
			);
	}
	
	public function canDelivering()
	{
		switch ($this->getStatusId()){
			case StatusOrder::STATUS_WAIT_FOR_DELIV:
				return true;
		}
		return false;
	}
	
	public function setDelivering()
	{
		DB::table('order_statuses')
			->insert(
				[
					'order_id'   => $this->getStatus()->order_id,
					'status_id'  => StatusOrder::STATUS_DELIVERING,
					'payment_id' => $this->getPayment()->payment_id
				]
			);
	}
	
	public function canDelivered()
	{
		switch ($this->getStatusId()){
			case StatusOrder::STATUS_DELIVERING:
				return true;
		}
		return false;
	}
	
	public function setDelivered()
	{
		DB::table('order_statuses')
			->insert(
				[
					'order_id'   => $this->getStatus()->order_id,
					'status_id'  => StatusOrder::STATUS_DELIVERED,
					'payment_id' => $this->getPayment()->payment_id
				]
			);
	}
	
	public function canCancel()
	{
		switch ($this->getStatusId()){
			case StatusOrder::STATUS_PROCESSING:
			case StatusOrder::STATUS_REBUILD:
			case StatusOrder::STATUS_BOXING:
			case StatusOrder::STATUS_COLLECTED:
			case StatusOrder::STATUS_WAIT_FOR_DELIV:
			case StatusOrder::STATUS_DELIVERING:
			case StatusOrder::STATUS_DELIVERED:
				return true;
		}
		return false;
	}
	
	public function setCancel()
	{
		DB::table('order_statuses')
			->insert(
				[
					'order_id'   => $this->getStatus()->order_id,
					'status_id'  => StatusOrder::STATUS_CANCEL,
					'payment_id' => $this->getPayment()->payment_id
				]
			);
	}
	
	public function canPaid()
	{
		switch ($this->getStatusId()){
			case StatusOrder::STATUS_PROCESSING:
			case StatusOrder::STATUS_REBUILD:
			case StatusOrder::STATUS_BOXING:
			case StatusOrder::STATUS_COLLECTED:
			case StatusOrder::STATUS_WAIT_FOR_DELIV:
			case StatusOrder::STATUS_DELIVERING:
			case StatusOrder::STATUS_DELIVERED:
				switch ($this->getPaymentId()){
					case StatusPayment::STATUS_WAITING:
						return true;
				}
				return false;
		}
		return false;
	}
	
	public function getPaymentId()
	{
		return $this->getPayment()->payment_id;
	}
	
	/**
	 * @return OrderStatus|null
	 */
	public function getPayment()
	{
		return OrderStatus::getLastByOrder($this);
	}
	
	public function setPaid()
	{
		DB::table('order_statuses')
			->insert(
				[
					'order_id'   => $this->getStatus()->order_id,
					'status_id'  => $this->getStatus()->status_id,
					'payment_id' => StatusPayment::STATUS_CASH
				]
			);
	}
	
	public function canRebuild()
	{
		switch ($this->getStatusId()){
			case StatusOrder::STATUS_PROCESSING:
				return true;
		}
		return false;
	}
	
	public function setRebuild()
	{
		DB::table('order_statuses')
			->insert(
				[
					'order_id'   => $this->getStatus()->order_id,
					'status_id'  => StatusOrder::STATUS_REBUILD,
					'payment_id' => $this->getPayment()->payment_id
				]
			);
	}
	
	public function canSendMail()
	{
		switch ($this->getStatusId()){
			case StatusOrder::STATUS_PROCESSING:
			case StatusOrder::STATUS_REBUILD:
			case StatusOrder::STATUS_BOXING:
			case StatusOrder::STATUS_COLLECTED:
			case StatusOrder::STATUS_WAIT_FOR_DELIV:
			case StatusOrder::STATUS_DELIVERING:
			case StatusOrder::STATUS_DELIVERED:
			case StatusOrder::STATUS_CANCEL:
				return true;
		}
		return false;
	}
	
	public function sendMail()
	{
		$data = Order::getProds($this->id); // Все продукты заказа
		$pdf  = \PDF::loadView('orderList', ['data' => $data, 'order' => $this])->setPaper('a4');
		Mail::send('backEmail', ['order' => $this], function ($message) use ($pdf){
			$message->from(Config::get('mail.username'), 'Bublic Shop');
			/*todo Не забудь заменить адрес КОМУ письмо на $this->email*/
			$message->to($this->email)->subject('Invoice');
			$message->attachData($pdf->output(), "orderList.pdf");
		});
	}
	
	public static function getProds($id)
	{
		return static::query()
			->select([
				'op.*',
				'p.name'
			])
			->fromRaw('order_prods AS op
				INNER JOIN products AS p
				ON op.product_id = p.id')
			->whereRaw('op.order_id = ?', [$id])
			->get();
	}
	
	public static function filterAndPagination($request)
	{
		$pagination = (isset($_GET['filter']['pagination']) && (int) $_GET['filter']['pagination'] <= 50 && (int) $_GET['filter']['pagination'] > 0) ? (int) $_GET['filter']['pagination'] : 5;
		$orders = Order::getList();
		$orders =  (new OrdersFilter($orders, $request))
			->apply()
			->paginate($pagination)
			->appends('filter[status]', request('filter.status'))
			->appends('filter[payment]', request('filter.payment'))
			->appends('filter[total_min]', request('filter.total_min'))
			->appends('filter[total_max]', request('filter.total_max'))
			->appends('filter[pagination]', request('filter.pagination'));
		return $orders;
	}
}
