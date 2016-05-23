<?php

namespace Pizza\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    /**
     * The application's global HTTP middleware stack.
     *
     * @var array
     */
    protected $middleware = [
        \Illuminate\Foundation\Http\Middleware\CheckForMaintenanceMode::class,
        \Pizza\Http\Middleware\EncryptCookies::class,
        \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
        \Illuminate\Session\Middleware\StartSession::class,
        \Illuminate\View\Middleware\ShareErrorsFromSession::class,
        \Pizza\Http\Middleware\VerifyCsrfToken::class,

    ];

    /**
     * The application's route middleware.
     *
     * @var array
     */
    protected $routeMiddleware = [
        'auth' => \Pizza\Http\Middleware\Authenticate::class,
        'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
        'guest' => \Pizza\Http\Middleware\RedirectIfAuthenticated::class,
        'hora' => \Pizza\Http\Middleware\hora::class,
        'admin_panel' => \Pizza\Http\Middleware\AdminPanel::class,
         'force_https_url_scheme' => Shin1x1\ForceHttpsUrlScheme\ForceHttpsUrlScheme::class, // <---added 
    ];
}
