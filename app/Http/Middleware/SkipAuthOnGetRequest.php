<?php

namespace App\Http\Middleware;

use Closure;

class SkipAuthOnGetRequest
{
    public function handle($request, Closure $next)
    {
        if ($request->isMethod('GET')) {
            return $next($request);
        }

        return app('auth')->guard('sanctum')->check(); // Apply middleware for non-GET requests
    }
}
