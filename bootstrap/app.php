<?php

use Illuminate\Auth\AuthenticationException;
use Illuminate\Auth\Middleware\Authenticate;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        api: __DIR__ . '/../routes/api.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
         $middleware->alias([
            'auth.jwt' => Authenticate::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        $exceptions->renderable(function (NotFoundHttpException $e, Request $request) {
            if ($request->is('api/*')) {
                return response()->json([
                    'statusCode' => 404,
                    'message' => 'Not Found',
                ], 404, [], JSON_PRETTY_PRINT);
            }
        });

        $exceptions->renderable(function (AuthenticationException $e, Request $request) {
            if ($request->is('api/*')) {
                return response()->json([
                    'statusCode' => 401,
                    'message' => 'Unauthenticated',
                ], 401, [], JSON_PRETTY_PRINT);
            }
        });

        $exceptions->renderable(function (MethodNotAllowedHttpException $e, Request $request) {
            if ($request->is('api/*')) {
                return response()->json([
                    'statusCode' => 405,
                    'message' => 'Method Not Allowed',
                ], 405, [], JSON_PRETTY_PRINT);
            }
        });

        $exceptions->renderable(function (Exception $e, Request $request) {
            if ($request->is('api/*')) {
                return response()->json([
                    'statusCode' => 500,
                    'message' => $e->getMessage(),
                ], 500, [], JSON_PRETTY_PRINT);
            }
        });
    })->create();
