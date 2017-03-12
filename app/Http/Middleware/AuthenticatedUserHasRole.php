<?php namespace cms\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Factory as Auth;
use Illuminate\Support\Facades\Gate;

/**
 * Class AuthenticatedUserHasRole
 * @package cms\Http\Middleware
 */
class AuthenticatedUserHasRole
{

    /**
     * The authentication factory instance.
     *
     * @var \Illuminate\Contracts\Auth\Factory
     */
    protected $auth;

    /**
     * Create a new middleware instance.
     *
     * @param  \Illuminate\Contracts\Auth\Factory $auth
     *
     * @return void
     */
    public function __construct(Auth $auth)
    {
        $this->auth = $auth;
    }

    /**
     * Handle an incoming request.
     *
     * @param         $request
     * @param Closure $next
     * @param array ...$roles
     *
     * @return mixed
     */
    public function handle($request, Closure $next, ...$roles)
    {
        $has_access = false;

        foreach ($roles as $role) {
            if (Gate::allows($role)) {
                $has_access = true;
                break;
            }
        }

        if (false === $has_access) {
            session()
                ->flash(
                    'message-error',
                    trans('auth.middleware_has_not_role_error')
                );
            return redirect(route(\Config::get('cms.frontend.home_route')));
        }

        return $next($request);
    }
}
