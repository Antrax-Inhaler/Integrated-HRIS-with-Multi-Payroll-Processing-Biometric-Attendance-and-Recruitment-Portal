<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Authenticate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next, ...$guards)
    {
        $this->authenticate($request, $guards);

        return $next($request);
    }

    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */

    /**
     * Authenticate the given request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  array  $guards
     * @return void
     */
    protected function authenticate(Request $request, array $guards)
    {
        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                return;
            }
        }

        abort(403, 'Unauthorized');
    }
    protected function redirectTo($request)
{
    if (! $request->expectsJson()) {
        // Check if the request is from an applicant
        if ($request->routeIs('applicant.*')) {
            return route('applicant.login');
        }
        return route('login');
    }
}

}