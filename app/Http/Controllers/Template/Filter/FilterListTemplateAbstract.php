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
     * @param $model
     * @param $params
     * @param $request
     * @return void
     * @todo: The template method defines the skeleton of an algorithm.
     * @todo: here the steps of the filtering
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
     * @param $model
     * @param $params
     * @return void
     * @todo: These operations already have implementations.
     */
    protected function init($model, $params): void
    {
        $this->builder = new FilterBuilder($model, $params);
    }

    /**
     * @return void
     */
    protected function applyWhere(): void
    {
        //apply conditions if possible
        $this->builder = $this->builder->where();
    }

    /**
     * @return void
     */
    protected function applySort(): void
    {
        //sort the results
        $this->builder = $this->builder->sort();
    }

    /**
     * @return mixed
     */
    protected function applyPagination()
    {
        //get the results after pagination
        return $this->builder->paginate();
    }

    /**
     * @param $request
     * @return void
     * @todo: These operations need implementations.
     */
    protected function applyWhereBetween($request): void
    {
        //not where between for this collection
        //$this->builder = $this->builder;
    }

}//class
