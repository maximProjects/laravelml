<?php
namespace App\Http\Middleware;

use Closure;
use Route;
class Languages
{
    /**
     * Han

    ndle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        //echo "Lng =". \Route::getCurrentRoute()->lang;
        //echo Route::getCurrentRoute()->getPrefix();
        //echo $request->route()->getPrefix();
      //  $currAction = $request->route()->getAction();
      //  echo $currAction;
        $request->attributes->add(['lang' => 'lt']);
        return $next($request);
    }
}
