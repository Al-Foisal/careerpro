<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string[]|null  ...$guards
     * @return mixed
     */
    public function handle($request, Closure $next, ...$guards)
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check() && $guard === 'web') {
                return redirect(RouteServiceProvider::HOME);
            } else if (Auth::guard($guard)->check() && $guard === 'admin'){
                return redirect()->route('admin.dashboard');
            } else if(Auth::guard($guard)->check() && $guard === 'instructor'){
                return redirect()->route('instructor.dashboard');
            }
        }

        return $next($request);
    }
}
