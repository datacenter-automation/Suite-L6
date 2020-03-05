<?php

namespace App\Http;

use App\Http\Middleware\ETag;
use App\Http\Middleware\Local;
use Fruitcake\Cors\HandleCors;
use App\Http\Middleware\Vendor;
use App\Http\Middleware\AuthLock;
use App\Http\Middleware\Customer;
use App\Http\Middleware\Internal;
use App\Http\Middleware\ActiveUser;
use App\Http\Middleware\APIversion;
use App\Http\Middleware\WhiteGlove;
use App\Http\Middleware\TrimStrings;
use App\Http\Middleware\Authenticate;
use App\Http\Middleware\LastModified;
use App\Http\Middleware\TrustProxies;
use App\Http\Middleware\EncryptCookies;
use Spatie\Honeypot\ProtectAgainstSpam;
use App\Http\Middleware\VerifyCsrfToken;
use Illuminate\Auth\Middleware\Authorize;
use Illuminate\Http\Middleware\SetCacheHeaders;
use Illuminate\Session\Middleware\StartSession;
use App\Http\Middleware\CheckForMaintenanceMode;
use App\Http\Middleware\RedirectIfAuthenticated;
use Spatie\Permission\Middlewares\RoleMiddleware;
use App\Http\Middleware\LogRequestsWithXRequestId;
use Illuminate\Routing\Middleware\ThrottleRequests;
use Illuminate\Foundation\Http\Kernel as HttpKernel;
use Illuminate\Routing\Middleware\ValidateSignature;
use Illuminate\Auth\Middleware\EnsureEmailIsVerified;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Fetzi\ServerTiming\Laravel\ServerTimingMiddleware;
use Illuminate\Session\Middleware\AuthenticateSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Spatie\Permission\Middlewares\PermissionMiddleware;
use Biscolab\LaravelAuthLog\Middleware\AuthLogMiddleware;
use Illuminate\Auth\Middleware\AuthenticateWithBasicAuth;
use Honeybadger\HoneybadgerLaravel\Middleware\UserContext;
use Illuminate\Foundation\Http\Middleware\ValidatePostSize;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Spatie\Permission\Middlewares\RoleOrPermissionMiddleware;
use Sarfraznawaz2005\Loading\Http\Middleware\LoadingMiddleware;
use Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull;

class Kernel extends HttpKernel
{

    /**
     * The application's global HTTP middleware stack.
     *
     * These middleware are run during every request to your application.
     *
     * @var array
     */
    protected $middleware = [
        CheckForMaintenanceMode::class,
        ValidatePostSize::class,
        TrimStrings::class,
        ConvertEmptyStringsToNull::class,
        HandleCors::class,
        TrustProxies::class,
        LogRequestsWithXRequestId::class,
        LoadingMiddleware::class,
        ProtectAgainstSpam::class,
        ServerTimingMiddleware::class,
    ];

    /**
     * The application's route middleware groups.
     *
     * @var array
     */
    protected $middlewareGroups = [
        'web' => [
            EncryptCookies::class,
            AddQueuedCookiesToResponse::class,
            StartSession::class,
            AuthenticateSession::class,
            ShareErrorsFromSession::class,
            VerifyCsrfToken::class,
            SubstituteBindings::class,
            UserContext::class,
        ],

        'api' => [
            'throttle:60,1',
            'bindings',
        ],
    ];

    /**
     * The priority-sorted list of middleware.
     *
     * This forces the listed middleware to always be in the given order.
     *
     * @var array
     */
    protected $middlewarePriority = [
        StartSession::class,
        ShareErrorsFromSession::class,
        Authenticate::class,
        AuthenticateSession::class,
        SubstituteBindings::class,
        Authorize::class,
    ];

    /**
     * The application's route middleware.
     *
     * These middleware may be assigned to groups or used individually.
     *
     * @var array
     */
    protected $routeMiddleware = [
        'api.version'        => APIversion::class,
        'auth'               => Authenticate::class,
        'auth.basic'         => AuthenticateWithBasicAuth::class,
        'auth.lock'          => AuthLock::class,
        'auth.log'           => AuthLogMiddleware::class,
        'active_user'        => ActiveUser::class,
        'bindings'           => SubstituteBindings::class,
        'cache.headers'      => SetCacheHeaders::class,
        'can'                => Authorize::class,
        'customer'           => Customer::class,
        'etag'               => ETag::class,
        'guest'              => RedirectIfAuthenticated::class,
        'internal'           => Internal::class,
        'last_modified'      => LastModified::class,/**/
        'local'              => Local::class,
        'permission'         => PermissionMiddleware::class,
        'role'               => RoleMiddleware::class,
        'role_or_permission' => RoleOrPermissionMiddleware::class,
        'signed'             => ValidateSignature::class,
        'throttle'           => ThrottleRequests::class,
        'vendor'             => Vendor::class,
        'verified'           => EnsureEmailIsVerified::class,
        'whitegloves'        => WhiteGlove::class,
    ];
}
