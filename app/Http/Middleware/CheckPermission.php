<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckPermission
{
    public function handle($request, Closure $next, $permission)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error','Please login first!');
        }

        if (!Auth::user()->hasPermission($permission)) {
            return redirect()->route('home')->with('error','Unauthorized action (missing permission).');
        }

        return $next($request);
    }
}

