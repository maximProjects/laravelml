<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Routing\Router;
class Languages
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        //echo Route::getCurrentRoute()->getPrefix();
        //echo $request->route()->getPrefix();
        return $next($request);
    }
}
