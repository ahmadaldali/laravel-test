<?php

namespace App\Http\Middleware;

use App\Models\User;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Support\Facades\Log;

class Authenticate extends Middleware
{
    /**
     * @param $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        return route('api.401');
    }
}
