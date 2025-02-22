<?php

namespace App\Http\Middleware;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;
class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo($request)
    {

            if (!$request->expectsJson()) {
            //    $locale = app()->getLocale(); // Get current locale

                if (app()->getLocale().('/admin*')) {
                    return redirect()->route('admin.login');
                } else {
                    return route('login');
                }
                return $request->expectsJson() ? null : route('login');

            }



        return null;
    }

}
