<?php

namespace App\Http\Middleware;

use Closure;

class CsrfExemptMiddleware
{
    public function handle($request, Closure $next)
    {
        $request->disableEscapingToken(); // Disables CSRF verification for this request only
        return $next($request);
    }
}