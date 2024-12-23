<?php

use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\Authenticate;
use App\Http\Middleware\LocalizationMiddleware;
use App\Http\Middleware\VerifyMobileMiddleware;
use App\Notifications\ErrorOccurred;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Schedule;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: [
            __DIR__.'/../routes/web.php',
            __DIR__.'/../routes/routes.php',
        ],
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'localization' => LocalizationMiddleware::class,
            'auth'         => Authenticate::class,
            'verified'         =>VerifyMobileMiddleware::class,
            'admin' => AdminMiddleware::class
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        $exceptions->report(function (Throwable $exception) {
            // send exeptions by email
            Notification::route('mail', 'gmta.constantine@gmail.com')
                ->notify(new ErrorOccurred($exception));
        });
    })->create();
