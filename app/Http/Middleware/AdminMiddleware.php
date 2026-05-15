<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Add your admin-specific logic here
        if (auth()->user()->role !== 'admin') {
            return redirect()->back()->with('error', 'Unauthorized');
        }
        return $next($request);
    }
}
