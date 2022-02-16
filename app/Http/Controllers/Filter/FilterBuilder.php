<?php

namespace App\Http\Controllers\Filter;

use Exception;
use Illuminate\Support\Facades\Log;

/**
 * The Builder interface specifies methods for creating the different parts of
 * the Product objects.
 */
class FilterBuilder implements FilterInterface
{

    private $model;
    private $list;

    /**
     * A fresh builder instance should contain a blank product object, which is
     * used in further assembly.
     */
    public function __construct($model, $list)
    {
        $this->model = $model;
        $this->list = $list;
    }

    /**
     *
     */
    public function where(): FilterInterface
    {
        //all received parameters
        $conditions = $this->list;
        //remove page, limit,sortBy, desc
        $removedKeys = ['page', 'limit', 'desc', 'sortBy'];
        foreach ($removedKeys as $key) {
            unset($conditions[$key]);
        }
        //get the keys of the remaining params
        $keys = array_keys($conditions);
        foreach ($keys as $key) {
            //of course here, the better to build chain design pattern instead of condition
            //cuz, maybe in the future we need to process additional params like dateRange
            ($key == 'from') ?
                $this->model->where('created_at', '>', $conditions[$key])
                : (
                    ($key == 'to') ?
                    $this->model->where('created_at', '<', $conditions[$key]) :
                    $this->model->where($key, $conditions[$key])
                );
        }
        return $this;
    }

    /**
     *
     *
     * @return FilterInterface
     */
    public function sort(): FilterInterface
    {
        $sortType = (array_key_exists('desc', $this->list) && $this->list['desc'] == 1) ? 'desc' : 'asc';
        if (array_key_exists('sortBy', $this->list))
            $this->model =  $this->model->orderBy($this->list['sortBy'], $sortType);

        return $this;
    }

    /**
     *
     */
    public function paginate()
    {
        try {
            $limit = (array_key_exists('limit', $this->list))
                ? (($this->list['limit'] >= 0) ? $this->list['limit'] : 0)
                : 0;
            return $this->model->paginate($limit);
        } catch (Exception $e) {
            //something error, for example, one of the params is not a column
            Log::info('error in filter builder: ' .  $e->getMessage());
            return null;
        } //catch
    } //paginate
}