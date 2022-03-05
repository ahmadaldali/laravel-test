<?php

namespace App\Http\Controllers\Filter;

interface FilterInterface
{
    public function where(): FilterInterface;

    public function whereBetween($begin, $end, $column = 'created_at'): FilterInterface;

    public function sort(): FilterInterface;

    public function paginate();
}
