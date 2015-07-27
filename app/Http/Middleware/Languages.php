<?php
namespace App\Http\Middleware;

use Closure;
use Route;
use Request;
use Illuminate\Contracts\Auth\Guard;
use App\Language;

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
        // get lang prefix from url
        $prefix = Request::segment(1);
        // find this lang in languages table
        $curLang = Language::wherePrefix($prefix)->first();
        if ($curLang) {
            // if language exist get all languages array
            $langs = Language::all();
            view()->share('curLang', $curLang);
            view()->share('langs', $langs);
            $request->lang = $curLang;
        } else {
            // if this language not found redirect to with default locale
            if (Request::segment(2) != 'image') {
                $default = $request->getDefaultLocale();
                $path = $request->path();
                return redirect($default . "/" . $path . "/");
            }
        }
        return $next($request);
    }
}
