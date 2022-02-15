<?php

namespace App\Traits;

use App\Http\Controllers\Filter\FilterBuilder;
use Illuminate\Support\Facades\Log;

trait ListsResult
{
    /**
     * Undocumented function
     *
     * @param [type] $model
     * @param [type] $request
     * @param array $addedParams
     * @return void
     */
    public function getTheResult($model, $request, $addedParams = [])
    {
        //validate page,limit,sort,desc
        $validatedData = $request->validated();
        //here we need to get all parameters not only validated,
        //but of course if we reach here, then the basic params is validated correctly
        $params = $request->all();
        //add extra params to the request, like is_admin for user-list
        foreach ($addedParams as $key => $value) {
            $params[$key] = $value;
        }
        Log::info($params);
        //apply the filter on them
        $records = (new FilterBuilder($model, $params))
            ->where()
            ->sort()
            ->paginate();
        Log::info($records);

        //check from the result
        if ($records == null) return response([], 422); //or 500
        return response($records, 200);
    } //method

}//trait
