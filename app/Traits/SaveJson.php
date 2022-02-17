<?php

namespace App\Traits;

trait SaveJson
{
    /**
     * @todo: to handle all process json attributes
     *
     * @param $data
     */
    public function convertJsonToObject($data)
    {
        return json_decode($data);
    } //method

}//trait