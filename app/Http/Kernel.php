<?php

namespace App\Http;

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
        \App\Http\Middleware\EncryptCookies::class,
        \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
        \Illuminate\Session\Middleware\StartSession::class,
        \Krucas\Notification\Middleware\NotificationMiddleware::class,
        \Illuminate\View\Middleware\ShareErrorsFromSession::class,
        \App\Http\Middleware\VerifyCsrfToken::class,
        \App\Http\Middleware\RedirectIfOnlyCity::class
    ];

    /**
     * The application's route middleware.
     *
     * @var array
     */
    protected $routeMiddleware = [
        'auth'       => \App\Http\Middleware\Authenticate::class,
        'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
        'guest'      => \App\Http\Middleware\RedirectIfAuthenticated::class,
        'owner'      => \App\Http\Middleware\RedirectIfNotOwnProfile::class,
        'role'       => \Bican\Roles\Middleware\VerifyRole::class,
        'permission' => \Bican\Roles\Middleware\VerifyPermission::class,
        'level'      => \Bican\Roles\Middleware\VerifyLevel::class,
        'token'      => \App\Http\Middleware\RedirectIfNoRegistrationToken::class,
        'remove-token' => \App\Http\Middleware\RemoveRegistrationToken::class,
        'hidden-city' => \App\Http\Middleware\SetNotificationForHiddenCity::class,
        'locale' => \App\Http\Middleware\SetLocaleForCity::class,
    ];
}
