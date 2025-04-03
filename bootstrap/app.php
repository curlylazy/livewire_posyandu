<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        // $middleware->redirectGuestsTo('/admin/login');
        $middleware->redirectGuestsTo(function (Request $request) use ($middleware) {
            if (! $request->expectsJson()) {
                if($request->is('admin') || $request->is('admin/*'))
                    $middleware->redirectGuestsTo('/admin/login');
                else
                    $middleware->redirectGuestsTo('/login');
            }
        });
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
