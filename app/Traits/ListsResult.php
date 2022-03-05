<?php

namespace App\Traits;

use App\Http\Controllers\Template\Filter\FilterListTemplate;
use App\Http\Controllers\Template\Filter\FilterListTemplateWithWhereBetween;

trait ListsResult
{
    /**
     * @param $model
     * @param $request
     * @param $addedParams
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     * @todo : filter the results of the request
     */
    public function getTheResult($model, $request, $addedParams = [])
    {
        //check if there is no list
        if (count($model) == 0) {
            return response(['data' => []], 200);
        }
        //process the list
        $model = $model->toQuery();
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
