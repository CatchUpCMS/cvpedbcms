<?php namespace cms\Modules\Users\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

/**
 * Class UserImpersonate
 *
 * If 'impersonate_member' key is set in session with a valid user id, we use the plateform as this user
 *
 * @package cms\Modules\Users\Http\Middleware
 */
class UserImpersonate
{
    /**
     * @param $request
     * @param Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

         //\Session::set('impersonate_member', 3 /* user id*/);
        // \Session::forget('impersonate_member');

        $id = 3;

        Auth::onceUsingId($id);

        /*if (
            Auth::check()
            && (
                true
                || Auth::user()->hasPermission('taking_session')
            )
            && $request->session()->has('impersonate_member')
            &&
        ) {

        }*/
        return $next($request);
    }
}
