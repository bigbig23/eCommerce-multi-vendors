<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Request;


class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {
           if(Request::is(app()->getLocale() .'/admin*')){ //since we have languages as prefix we have to add app()->getLocale()
               return route('admin.login');
           }else{
               return route('login');
           }
        }
    }
}
