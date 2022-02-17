<?php


namespace App\Http\Controllers\Template\Filter;

use App\Traits\fixRange;
use App\Traits\SaveJson;

/**
 *
 */
class FilterListTemplateWithWhereBetween extends FilterListTemplateAbstract
{
    use fixRange;
    use SaveJson;

    /**
     * @todo: where between condition
     *
     * @return void
     */
    protected function applyWhereBetween($request): void
    {
        //check from data range if exist
        if ($request->has('dataRange')) {
            //get from and to attributes
            $dataRange = $this->convertJsonToObject($request->dataRange);
            //apply where range condition
            $this->builder = $this->builder->whereBetween($dataRange->from, $dataRange->to);
        } //data range

        //check from fix range if exist
        if ($request->has('fixRange')) {
            //get from and to attributes
            $fixRange = $this->getFixRangeDates($request->fixRange);
            //apply where range condition
            $this->builder = $this->builder->whereBetween($fixRange['from'], $fixRange['to']);
        } //fix range

    } //applyWhereBetween

}//class
