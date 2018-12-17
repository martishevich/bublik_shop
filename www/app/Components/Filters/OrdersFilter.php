<?php

namespace App\Components\Filters;

class OrdersFilter extends QueryFilter
{
	public function id($value)
	{
		if (!$value) return;
		$this->builder->where('id','=', $value);
	}
}