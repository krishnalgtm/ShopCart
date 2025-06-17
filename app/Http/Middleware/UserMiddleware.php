<?php

namespace App\Http\Middleware;

use Closure;

class UserMiddleware
{
    public function handle($request, Closure $next)
    {
        // Admin को सभी access की अनुमति दें
        if (auth()->check() && auth()->user()->hasRole('admin')) {
            return $next($request);
        }

        // अन्य users के लिए user_id चेक करें
        if (auth()->check() && auth()->user()->id == $request->user_id) {
            return $next($request);
        }

        // Access Denied
        return response()->json(['message' => 'Forbidden'], 403);
    }
}
