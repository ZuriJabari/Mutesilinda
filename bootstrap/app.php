<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;
use Illuminate\Session\TokenMismatchException;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpKernel\Exception\HttpException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        //
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        $exceptions->renderable(function (TokenMismatchException $e, Request $request) {
            if ($request->is('livewire/*')) {
                Log::warning('Livewire token mismatch', [
                    'method' => $request->method(),
                    'path' => $request->path(),
                    'url' => $request->fullUrl(),
                    'host' => $request->getHost(),
                    'origin' => $request->headers->get('origin'),
                    'referer' => $request->headers->get('referer'),
                    'user_id' => optional($request->user())->getAuthIdentifier(),
                ]);
            }
        });

        $exceptions->renderable(function (HttpException $e, Request $request) {
            if ($request->is('livewire/*') && $e->getStatusCode() === 401) {
                Log::warning('Livewire unauthorized (likely invalid signature)', [
                    'method' => $request->method(),
                    'path' => $request->path(),
                    'url' => $request->fullUrl(),
                    'host' => $request->getHost(),
                    'origin' => $request->headers->get('origin'),
                    'referer' => $request->headers->get('referer'),
                    'user_id' => optional($request->user())->getAuthIdentifier(),
                ]);
            }
        });
    })->create();
