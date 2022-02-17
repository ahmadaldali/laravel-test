<?php

namespace App\Traits;

use App\Http\Controllers\Template\Filter\FilterListTemplate;
use App\Http\Controllers\Template\Filter\FilterListTemplateWithWhereBetween;

trait ListsResult
{
    /**
     * filter the results of the request
     *
     * @param $model
     * @param $request
     * @param $addedParams
     */
    public function getTheResult($model, $request, $addedParams = [])
    {
        //validate page,limit,sort,desc
        $validatedData = $request->validated();
        //here we need to get all parameters not only validated,
        //but of course if we reach here, then the basic params is validated correctly
        //remove dataRange,fixRange to format it according the suitable
        $params = $request->except(['dataRange', 'fixRange']);
        //add extra params to the request, like is_admin for user-list
        foreach ($addedParams as $key => $value) {
            $params[$key] = $value;
        }

        //choose the suitable template
        //it's better to use chain design pattern, for the future
        if ($request->has('dataRange') || $request->has('fixRange')) {
            $template = new FilterListTemplateWithWhereBetween();
        } else {
            $template = new FilterListTemplate();
        }
        //filter and fetch the final result
        $records = $template->filter($model, $params, $request);

        //check from the result
        if ($records == null) return response([], 422); //or 500
        return response($records, 200);
    } //method

}//trait
