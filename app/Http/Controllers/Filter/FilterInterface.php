<?php

namespace App\Http\Controllers\Filter;

/**
 * The Builder interface specifies methods for creating the different parts of
 * the Product objects.
 */
interface FilterInterface
{
    public function where(): FilterInterface;
    public function sort(): FilterInterface;
    public function paginate();
}