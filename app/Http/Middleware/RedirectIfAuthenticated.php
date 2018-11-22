<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @param  string|null $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        switch ($guard) {
            case "web":
                if (Auth::guard('web')->check()) {
                    return redirect('/admin');
                }
                break;
            case "customer":
                if (Auth::guard('customer')->check()) {
                    return redirect('/');
                }
                break;
        }


        return $next($request);
    }
}
