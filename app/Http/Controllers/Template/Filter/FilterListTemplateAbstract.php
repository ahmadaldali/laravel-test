<?php


namespace App\Http\Controllers\Template\Filter;

use App\Http\Controllers\Filter\FilterBuilder;


/**
 * filtering process
 */
abstract class FilterListTemplateAbstract
{
    protected $builder = null;
    /**
     * The template method defines the skeleton of an algorithm.
     * here the steps of the filtering
     */
    final public function filter($model, $params, $request)
    {
        //step1 - take object from the builder
        $this->init($model, $params);
        //step2 - apply normal conditions
        $this->applyWhere();
        //step3- apply range conditions
        $this->applyWhereBetween($request);
        //step4- sort the results
        $this->applySort();
        //step5- perform  pagination and get the results
        return $this->applyPagination();
    } //filter


    /**
     * These operations already have implementations.
     */
    protected function init($model, $params): void
    {
        $this->builder = new FilterBuilder($model, $params);
    }
    /**
     * where
     *
     * @return void
     */
    protected function applyWhere(): void
    {
        //apply conditions if possible
        $this->builder = $this->builder->where();
    }
    /**
     * sort
     *
     * @return void
     */
    protected function applySort(): void
    {
        //sort the results
        $this->builder = $this->builder->sort();
    }
    /**
     * paginate
     *
     * @return void
     */
    protected function applyPagination()
    {
        //get the results after pagination
        return $this->builder->paginate();
    }

    /**
     * These operations need implementations.
     *
     * @return void
     */
    protected function applyWhereBetween($request): void
    {
        //not where between for this collection
        //$this->builder = $this->builder;
    }
}//class
