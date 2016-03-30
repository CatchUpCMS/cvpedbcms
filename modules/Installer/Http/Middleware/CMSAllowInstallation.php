<?php

namespace Modules\Installer\Http\Middleware;

use Closure;

class CMSAllowInstallation
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
        if (env('APP_INSTALLED')) {
            return redirect('/');
        }
        return $next($request);
    }
}