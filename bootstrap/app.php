<?php

use App\Exceptions\ApplicationException;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        //
    })
    ->withExceptions(function (Exceptions $exceptions) {
        $exceptions->render(function (ApplicationException $e, Request $request) {
            $shortname = (new ReflectionClass($e))->getShortName();
            $payload = [
                'error' => [
                    'message'   => $e->getMessage(),
                    'code'      => $e->getCode(),
                    'title'     => $shortname,
                ]
            ];
            return response()->json($payload, $e->getCode());
        });
    })->create();
