<?php

namespace App\Jobs;

use App\Order;
use Illuminate\Support\Facades\Config;
use Mail;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class SendMessage implements ShouldQueue
{
	use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
	protected $order;
	
	public function __construct($order)
	{
		$this->order = $order;
	}
	
	/**
	 * Execute the job.
	 *
	 * @return void
	 */
	public function handle()
	{
		$data = Order::getProds($this->order->id); // Все продукты заказа
		$pdf  = \PDF::loadView('orderList', ['data' => $data, 'order' => $this->order])->setPaper('a4');
		Mail::send('backEmail', ['order' => $this->order], function ($message) use ($pdf){
			$message->from(Config::get('mail.username'), 'Bublic Shop');
			$message->to($this->order->email)->subject('Invoice');
			$message->attachData($pdf->output(), "orderList.pdf");
		});
	}
}
