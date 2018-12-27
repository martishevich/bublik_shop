<?php

namespace App\Components\Filters;
class OrdersFilter extends QueryFilter
{
	const PAGINATIONS = [5, 30, 50, 100];
	
	public function id($value)
	{
		if (!$value)
			return;
		$this->builder->where('id', '=', $value);
	}
	
	public function status($value)
	{
		if (!$value)
			return;
		$this->builder->whereIn('status_id', $value);
	}
	
	public function payment($value)
	{
		if (!$value)
			return;
		$this->builder->whereIn('payment_id', $value);
	}
	
	public function total_min($value)
	{
		if (!$value)
			return;
		$this->builder->where('total', '>=', (int)$value);
	}
	
	public function total_max($value)
	{
		if (!$value)
			return;
		$this->builder->where('total', '<=', (int)$value);
	}
	
	
}