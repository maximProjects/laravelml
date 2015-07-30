<?php
namespace App\Http\Middleware;

use Closure;
use Route;
use Request;
use Illuminate\Contracts\Auth\Guard;
use App\Language;
use TrlHelper;

/**
 * Class Languages
 * @package App\Http\Middleware
 * Detect language from url if it no exist change kanguage to default and redirect
 */
class Languages
{
    /**
     * The Guard implementation.
     *
     * @var Guard
     */
    protected $lang;

    /**
     * Create a new filter instance.
     *
     * @param  Guard  $lang
     * @return void
     */
    public function __construct(Guard $lang)
    {
        $this->lang = $lang;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */

    public function handle($request, Closure $next)
    {
        $prefix = Request::segment(1);
        \App\Helpers\TrlHelper::t($prefix);
        return $next($request);
    }
}
