<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        if (!$request->user() || !in_array($request->user()->role, $roles)) {
            if (!$request->user()) {
                return redirect()->route('login')->with('error', 'Please log in to access this page.');
            }
            // User is logged in but unauthorized for this specific route
            return redirect('/')->with('error', 'Unauthorized access.');
        }

        return $next($request);
    }
} 