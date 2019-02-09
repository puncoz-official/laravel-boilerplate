<?php

namespace App\StartUp\Middleware;

use Closure;

/**
 * Class RedirectIfAuthenticated
 * @package App\StartUp\Middleware
 */
class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure                 $next
     * @param  string|null              $guard
     *
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if ( auth()->guard($guard)->check() ) {
            return redirect()->to(route('back.dashboard'));
        }

        return $next($request);
    }
}
