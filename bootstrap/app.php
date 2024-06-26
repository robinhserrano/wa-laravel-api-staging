<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Http\Middleware\Cors;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'skipAuthOnGetReq' => \App\Http\Middleware\SkipAuthOnGetRequest::class,
            'csrfExempt' => \App\Http\Middleware\CsrfExemptMiddleware::class,
       
        ]);
        $middleware->validateCsrfTokens(except:['/*']);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
