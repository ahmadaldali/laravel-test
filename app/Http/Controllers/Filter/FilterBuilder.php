<?php

namespace App\Http\Controllers\Filter;

use Exception;
use Illuminate\Support\Facades\Log;

/**
 * The Builder interface specifies methods for return the different types of
 * the Lists.
 */
class FilterBuilder implements FilterInterface
{
    private $model;
    private $list;

    /**
     * @param $model
     * @param $list
     */
    public function __construct($model, $list)
    {
        $this->model = $model;
        $this->list = $list;
    }

    /**
     * @return FilterInterface
     */
    public function where(): FilterInterface
    {
        //all received parameters
        $conditions = $this->list;
        //remove page, limit,sortBy, desc if they exist
        $removedKeys = ['page', 'limit', 'desc', 'sortBy'];
        foreach ($removedKeys as $key) {
            unset($conditions[$key]);
        }
        //get the keys of the remaining params
        $keys = array_keys($conditions);
        foreach ($keys as $key) {
            $this->model->where($key, $conditions[$key]);
        }
        return $this;
    }

    /**
     * @param $begin
     * @param $end
     * @param $column
     * @return FilterInterface
     */
    public function whereBetween($begin, $end, $column = 'created_at'): FilterInterface
    {
        $this->model->whereBetween($column, [$begin, $end]);
        return $this;
    }

    /**
     * @return FilterInterface
     */
    public function sort(): FilterInterface
    {
        $sortType = (array_key_exists('desc', $this->list) && $this->list['desc'] == 1) ? 'desc' : 'asc';
        if (array_key_exists('sortBy', $this->list)) {
            $this->model = $this->model->orderBy($this->list['sortBy'], $sortType);
        }
        return $this;
    }

    public function paginate()
    {
        try {
            $limit = (array_key_exists('limit', $this->list))
                ? (($this->list['limit'] >= 0) ? $this->list['limit'] : 0)
                : 0;
            return $this->model->paginate($limit);
        } catch (Exception $e) {
            //something error, for example, one of the params is not a column
            Log::info('error in filter builder: ' . $e->getMessage());
            return null;
        } //catch
    } //paginate

}//interface
