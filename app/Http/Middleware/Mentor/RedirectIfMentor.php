<?php

namespace App\Http\Middleware\Mentor;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfMentor
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @param string|null $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = 'mentor')
    {
        
        if (Auth::guard($guard)->check()) {
            return redirect(route('mentor.app_form'));
        }
        return $next($request);
    }
}
