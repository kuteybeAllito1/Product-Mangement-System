<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CheckAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::check()) {
            return redirect()->route('admin.login')->with('error','You must log in first.');
        }
    
        if (Auth::user()->isSuperAdmin()) {
            return $next($request);
        }
    
        if (Auth::user()->can_access_admin) {
            return $next($request);
        }
    
        Auth::logout();
        return redirect()->route('home')->with('error','Unauthorized action.');
    }
}
