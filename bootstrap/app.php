<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Foundation\Configuration\Exceptions;
use App\Http\Middleware\EncryptCookies;
use App\Http\Middleware\StartSession;
use App\Http\Middleware\VerifyCsrfToken;
use App\Http\Middleware\Authenticate;
use App\Http\Middleware\RoleMiddleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function ($middleware) {
        return [
            // Global middleware
            EncryptCookies::class,
            StartSession::class,
            VerifyCsrfToken::class,
            
            $middleware->alias([
                'role' => RoleMiddleware::class,
                'auth' => Authenticate::class,
            ])
        ];
    })

    ->withExceptions(function (Exceptions $exceptions) {
        //
    })
    ->create();
