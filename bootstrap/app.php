
<?php

use App\Http\Middleware\HandleAppearance;
use App\Http\Middleware\HandleInertiaRequests;
use App\Http\Middleware\SetTeamUrlDefaults;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Middleware\AddLinkHeadersForPreloadedAssets;
use Illuminate\Http\Request;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->encryptCookies(except: ['appearance', 'sidebar_state']);

        $middleware->web(append: [
            HandleAppearance::class,
            HandleInertiaRequests::class,
            AddLinkHeadersForPreloadedAssets::class,
            SetTeamUrlDefaults::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        $exceptions->shouldRenderJsonWhen(
            fn (Request $request) => $request->is('api/*') || $request->expectsJson(),
        );

        $exceptions->report(function (\Throwable $e): void {
            error_log(
                'ORIGINAL LARAVEL ERROR: '.get_class($e).' - '.$e->getMessage()
            );

            error_log($e->getTraceAsString());
        });

        $exceptions->render(function (\Throwable $e, Request $request) {
            error_log(
                'LARAVEL ORIGINAL EXCEPTION: '.get_class($e).' - '.$e->getMessage()
            );

            error_log($e->getTraceAsString());

            return new \Symfony\Component\HttpFoundation\Response(
                'Laravel exception logged. Check Vercel Runtime Logs.',
                500
            );
        });
    })
    ->create();
