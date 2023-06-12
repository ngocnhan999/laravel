<?php

namespace App\Http\Middleware\Mentor;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfNotMentor
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @param  string|null $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = 'mentor')
    {
        
        if (!Auth::guard($guard)->check()) {
            if ($request->ajax() || $request->wantsJson()) {
                return response('Unauthorized.', 401);
            }

            return redirect()->guest(route('mentor.login'));
        }

        return $next($request);
    }
}
