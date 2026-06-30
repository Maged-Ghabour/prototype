<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

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
        $exceptions->renderable(function (\Livewire\Exceptions\PayloadTooLargeException $e, $request) {
            $response = new \Illuminate\Http\RedirectResponse(url()->previous());
            return $response->with('error', 'حجم البيانات أو الملف المرفوع كبير جداً. يرجى تقليل الحجم والمحاولة مرة أخرى.');
        });
        
        $exceptions->renderable(function (\Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException $e, $request) {
            return new \Illuminate\Http\RedirectResponse(route('portfolio'));
        });
    })->create();
