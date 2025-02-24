<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CheckAdminSeller
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error','You must log in first.');
        }

        $role = Auth::user()->role;
        if ($role !== 'admin' && $role !== 'seller') {
            return redirect()->route('home')->with('error','Unauthorized action.');
        }

        return $next($request);
    }
}
