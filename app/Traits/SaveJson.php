<?php

namespace App\Traits;

trait SaveJson
{

    /**
     * @param $data
     * @return mixed
     * @todo: to handle all process json attributes
     */
    public function convertJsonToObject($data)
    {
        return json_decode($data);
    } //method

}//trait
