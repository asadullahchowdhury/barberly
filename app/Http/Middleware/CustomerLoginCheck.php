<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;


class CustomerLoginCheck
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @param string|null $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        $path = Request::route()->getName();
        if (Auth::guard('customers')->check()) {
            if($path == 'lvs.auth.customer.any') {
                return redirect()->route('lvs.customer.home');
            } else {
                return $next($request);
            }
        } else {
            if($path == 'lvs.auth.customer.any') {
                return $next($request);
            } else {
                return redirect()->route('lvs.auth.customer.any', 'sign-in');
            }
        }
    }
}
