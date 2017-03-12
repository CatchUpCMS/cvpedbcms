<?php namespace cms\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Lang;

/**
 * Class SetLocaleMiddleware
 * @package cms\Http\Middlewares
 */
class SetLocaleMiddleware
{

    /**
     * The availables languages.
     *
     * @array $languages
     */
    protected $languages = ['en'];

    /**
     * SetLocaleMiddleware constructor.
     */
    public function __construct()
    {
        $languages = config('cms.languages');

        if (is_array($languages) && !empty($languages)) {
            $this->languages = $languages;
        }
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (
            (
                !Session::has('lang')
                && isset($request->lang)
                && !empty($request->lang)
                && in_array($request->lang, $this->languages)
            )
            || (
                Session::has('lang')
                && isset($request->lang)
                && !empty($request->lang)
                && in_array($request->lang, $this->languages)
                && $request->lang != Session::get('lang')
            )
        ) {
            Session::put('lang', $request->lang);
            Lang::setlocale($request->lang);
        } else if (
            !Session::has('lang')
            && !isset($request->lang)
        ) {
            Session::put('lang', App::getLocale());
            Lang::setlocale(App::getLocale());
        } else if (Session::has('lang')) {
            Lang::setlocale(Session::get('lang'));
        }

        return $next($request);
    }

}
