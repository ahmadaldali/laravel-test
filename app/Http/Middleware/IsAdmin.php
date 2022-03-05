<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;

class IsAdmin
{
    /**
     * @param Request $request
     * @param Closure $next
     * @return \Illuminate\Http\RedirectResponse|mixed
     */
    public function handle(Request $request, Closure $next)
    {
        //check if there is a logged in user and he is admin
        $user = User::getLoggedUser();
        if ($user &&  $user->is_admin == 1) {
            return $next($request);
        }
        return redirect()->route('api.401');
    } //handle

}
