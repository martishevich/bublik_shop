<?php

namespace App\Components\Filters;

abstract class QueryFilter
{
    protected $builder;
    protected $request;

    public function __construct($builder, $request)
    {
        $this->builder = $builder;
        $this->request = $request;
    }

    public function apply()
    {
        if (isset($this->filters()['filter'])) {
            foreach ($this->filters()['filter'] as $filter => $value) {
                if (method_exists($this, $filter)) {
                    $this->$filter($value);
                }
            }
        }

        return $this->builder;
    }

    public function filters()
    {
        return $this->request->all();
    }
}
