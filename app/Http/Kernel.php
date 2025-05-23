<?php

namespace App\Http;

use Illuminate\Auth\Middleware\Authenticate;
use Illuminate\Auth\Middleware\RedirectIfAuthenticated;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Kernel as HttpKernel;
use Illuminate\Foundation\Http\Middleware\PreventRequestsDuringMaintenance;
use Illuminate\Foundation\Http\Middleware\TrimStrings;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Http\Middleware\TrustProxies;
use Illuminate\Routing\Middleware\ValidateSignature;

class Kernel extends HttpKernel
{
  /**
   * The application's global HTTP middleware stack.
   *
   * These middleware are run during every request to your application.
   *
   * @var array<int, class-string|string>
   */
  protected $middleware = [
    // \App\Http\Middleware\TrustHosts::class,
    TrustProxies::class,
    \Illuminate\Http\Middleware\HandleCors::class,
    PreventRequestsDuringMaintenance::class,
    \Illuminate\Foundation\Http\Middleware\ValidatePostSize::class,
    TrimStrings::class,
    \Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull::class,
  ];

  /**
   * The application's route middleware groups.
   *
   * @var array<string, array<int, class-string|string>>
   */
  protected $middlewareGroups = [
    'web' => [
      EncryptCookies::class,
      \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
      \Illuminate\Session\Middleware\StartSession::class,
      \Illuminate\View\Middleware\ShareErrorsFromSession::class,
      VerifyCsrfToken::class,
      \Illuminate\Routing\Middleware\SubstituteBindings::class,
      \RealRashid\SweetAlert\ToSweetAlert::class,
    ],

    'api' => [
      \Illuminate\Routing\Middleware\ThrottleRequests::class . ':api',
      \Illuminate\Routing\Middleware\SubstituteBindings::class,
    ],
  ];

  /**
   * The application's middleware aliases.
   *
   * Aliases may be used instead of class names to conveniently assign middleware to routes and groups.
   *
   * @var array<string, class-string|string>
   */
  protected $middlewareAliases = [
    'auth' => Authenticate::class,
    'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
    'auth.session' => \Illuminate\Session\Middleware\AuthenticateSession::class,
    'cache.headers' => \Illuminate\Http\Middleware\SetCacheHeaders::class,
    'can' => \Illuminate\Auth\Middleware\Authorize::class,
    'guest' => RedirectIfAuthenticated::class,
    'password.confirm' => \Illuminate\Auth\Middleware\RequirePassword::class,
    'signed' => ValidateSignature::class,
    'throttle' => \Illuminate\Routing\Middleware\ThrottleRequests::class,
    'verified' => \Illuminate\Auth\Middleware\EnsureEmailIsVerified::class,
    'sweetalert' => \RealRashid\SweetAlert\ToSweetAlert::class,
  ];
}
