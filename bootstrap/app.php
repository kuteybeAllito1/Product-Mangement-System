<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use  App\Http\Middleware\CheckAdminSeller;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'admin.seller' => \App\Http\Middleware\CheckAdminSeller::class,
            'admin.only'   => \App\Http\Middleware\CheckAdmin::class,
            'permission' => \App\Http\Middleware\CheckPermission::class,

        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
