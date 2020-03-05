<?php

use App\Helpers\Logger;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Facades\App\General\DcasLogger;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\View;
use App\Providers\AppServiceProvider;
use Auth0\Login\LoginServiceProvider;
use Fouladgar\EloquentBuilder\Facade;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Queue;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Route;
use App\Providers\MenuServiceProvider;
use Illuminate\Bus\BusServiceProvider;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Schema;
use App\Providers\EventServiceProvider;
use App\Providers\RouteServiceProvider;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Auth\AuthServiceProvider;
use Illuminate\Mail\MailServiceProvider;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;
use Illuminate\View\ViewServiceProvider;
use Illuminate\Support\Facades\Broadcast;
use Illuminate\Support\Facades\Validator;
use Illuminate\Cache\CacheServiceProvider;
use Illuminate\Queue\QueueServiceProvider;
use Illuminate\Redis\RedisServiceProvider;
use Pyaesone17\Lapse\LapseServiceProvider;
use Illuminate\Hashing\HashServiceProvider;
use Illuminate\Cookie\CookieServiceProvider;
use Illuminate\Support\Facades\Notification;
use Fouladgar\EloquentBuilder\ServiceProvider;
use Illuminate\Session\SessionServiceProvider;
use App\Providers\OtherValidationRulesProvider;
use Illuminate\Database\DatabaseServiceProvider;
use Illuminate\Pipeline\PipelineServiceProvider;
use Illuminate\Encryption\EncryptionServiceProvider;
use Illuminate\Filesystem\FilesystemServiceProvider;
use Illuminate\Pagination\PaginationServiceProvider;
use Illuminate\Validation\ValidationServiceProvider;
use Illuminate\Broadcasting\BroadcastServiceProvider;
use Illuminate\Translation\TranslationServiceProvider;
use JeroenNoten\LaravelAdminLte\AdminLteServiceProvider;
use Illuminate\Notifications\NotificationServiceProvider;
use Illuminate\Auth\Passwords\PasswordResetServiceProvider;
use Illuminate\Foundation\Providers\FoundationServiceProvider;
use GrahamCampbell\GitHub\Facades\GitHub as GrahamCampbellGitHub;
use Illuminate\Foundation\Providers\ConsoleSupportServiceProvider;
use App\Providers\MailboxServiceProvider as AppMailboxServiceProvider;
use ComdexxSolutionsLLC\MySQLScout\Providers\MySQLScoutServiceProvider;

return [
    /*
    |--------------------------------------------------------------------------
    | Application Name
    |--------------------------------------------------------------------------
    |
    | This value is the name of your application. This value is used when the
    | framework needs to place the application's name in a notification or
    | any other location as required by the application or its packages.
    |
    */

    'name' => env('APP_NAME', 'Please set the application name in your configuration.'),

    /*
    |--------------------------------------------------------------------------
    | Application Environment
    |--------------------------------------------------------------------------
    |
    | This value determines the "environment" your application is currently
    | running in. This may determine how you prefer to configure various
    | services the application utilizes. Set this in your ".env" file.
    |
    */

    'env' => env('APP_ENV', 'production'),

    /*
    |--------------------------------------------------------------------------
    | Application Debug Mode
    |--------------------------------------------------------------------------
    |
    | When your application is in debug mode, detailed error messages with
    | stack traces will be shown on every error that occurs within your
    | application. If disabled, a simple generic error page is shown.
    |
    */

    'debug' => env('APP_DEBUG', false),

    /*
    |--------------------------------------------------------------------------
    | Application URL
    |--------------------------------------------------------------------------
    |
    | This URL is used by the console to properly generate URLs when using
    | the Artisan command line tool. You should set this to the root of
    | your application so that it is used when running Artisan tasks.
    |
    */

    'url' => env('APP_URL', 'http://localhost'),

    'asset_url' => env('ASSET_URL', null),

    /*
    |--------------------------------------------------------------------------
    | Application Timezone
    |--------------------------------------------------------------------------
    |
    | Here you may specify the default timezone for your application, which
    | will be used by the PHP date and date-time functions. We have gone
    | ahead and set this to a sensible default for you out of the box.
    |
    */

    'timezone' => env('APP_TIMEZONE', 'UTC'),

    /*
    |--------------------------------------------------------------------------
    | Application Locale Configuration
    |--------------------------------------------------------------------------
    |
    | The application locale determines the default locale that will be used
    | by the translation service provider. You are free to set this value
    | to any of the locales which will be supported by the application.
    |
    */

    'locale' => env('APP_LOCALE', 'en'),

    /*
    |--------------------------------------------------------------------------
    | Application Fallback Locale
    |--------------------------------------------------------------------------
    |
    | The fallback locale determines the locale to use when the current one
    | is not available. You may change the value to correspond to any of
    | the language folders that are provided through your application.
    |
    */

    'fallback_locale' => env('APP_FALLBACK_LOCALE', 'en'),

    /*
    |--------------------------------------------------------------------------
    | Faker Locale
    |--------------------------------------------------------------------------
    |
    | This locale will be used by the Faker PHP library when generating fake
    | data for your database seeds. For example, this will be used to get
    | localized telephone numbers, street address information and more.
    |
    */

    'faker_locale' => env('FAKER_LOCALE', 'en_US'),

    /*
    |--------------------------------------------------------------------------
    | Encryption Key
    |--------------------------------------------------------------------------
    |
    | This key is used by the Illuminate encrypter service and should be set
    | to a random, 32 character string, otherwise these encrypted strings
    | will not be safe. Please do this before deploying an application!
    |
    */

    'key' => env('APP_KEY'),

    'cipher' => 'AES-256-CBC',

    /*
    |-------------------------------------------
    | API Version
    |-------------------------------------------
    |
    | This value is the version of your api.
    | It's used when there's no specified
    | version on the routes, so it will take this
    | as the default, or current.
     */

    'api_version' => env('API_VERSION', null),

    'api_latest' => env('API_LATEST', null),

    /*
    |--------------------------------------------------------------------------
    | Autoloaded Service Providers
    |--------------------------------------------------------------------------
    |
    | The service providers listed here will be automatically loaded on the
    | request to your application. Feel free to add your own services to
    | this array to grant expanded functionality to your applications.
    |
    */

    'providers' => [
        /*
         * Laravel Framework Service Providers...
         */
        AuthServiceProvider::class,
        BroadcastServiceProvider::class,
        BusServiceProvider::class,
        CacheServiceProvider::class,
        ConsoleSupportServiceProvider::class,
        CookieServiceProvider::class,
        DatabaseServiceProvider::class,
        EncryptionServiceProvider::class,
        FilesystemServiceProvider::class,
        FoundationServiceProvider::class,
        HashServiceProvider::class,
        MailServiceProvider::class,
        NotificationServiceProvider::class,
        PaginationServiceProvider::class,
        PipelineServiceProvider::class,
        QueueServiceProvider::class,
        RedisServiceProvider::class,
        PasswordResetServiceProvider::class,
        SessionServiceProvider::class,
        TranslationServiceProvider::class,
        ValidationServiceProvider::class,
        ViewServiceProvider::class,

        /*
         * Package Service Providers...
         */
        MySQLScoutServiceProvider::class,
        //LapseServiceProvider::class,
        ServiceProvider::class,
        AdminLteServiceProvider::class,
        OtherValidationRulesProvider::class,
        LoginServiceProvider::class,

        /*
         * Application Service Providers...
         */
        AppServiceProvider::class,
        AuthServiceProvider::class,
        BroadcastServiceProvider::class,
        EventServiceProvider::class,
        MenuServiceProvider::class,
        RouteServiceProvider::class,
        AppMailboxServiceProvider::class,
    ],

    /*
    |--------------------------------------------------------------------------
    | Class Aliases
    |--------------------------------------------------------------------------
    |
    | This array of class aliases will be registered when this application
    | is started. However, feel free to register as many as you wish as
    | the aliases are "lazy" loaded so they don't hinder performance.
    |
    */

    'aliases' => [
        'App'             => App::class,
        'Arr'             => Arr::class,
        'Artisan'         => Artisan::class,
        'Auth'            => Auth::class,
        'Auth0'           => Auth0\Login\Facade\Auth0::class,
        'Blade'           => Blade::class,
        'Broadcast'       => Broadcast::class,
        'Bus'             => Bus::class,
        'Cache'           => Cache::class,
        'Config'          => Config::class,
        'Cookie'          => Cookie::class,
        'Crypt'           => Crypt::class,
        'DB'              => DB::class,
        'Eloquent'        => Model::class,
        'EloquentBuilder' => Facade::class,
        'Event'           => Event::class,
        'File'            => File::class,
        'Gate'            => Gate::class,
        'GitHub'          => GrahamCampbellGitHub::class,
        'Hash'            => Hash::class,
        'Lang'            => Lang::class,
        'Log'             => Log::class,
        //'Log'             => DcasLogger::class,
        'Logger'          => Logger::class,
        'Mail'            => Mail::class,
        'Notification'    => Notification::class,
        'Password'        => Password::class,
        'Queue'           => Queue::class,
        'Redirect'        => Redirect::class,
        'Redis'           => Redis::class,
        'Request'         => Request::class,
        'Response'        => Response::class,
        'Route'           => Route::class,
        'Schema'          => Schema::class,
        'Session'         => Session::class,
        'Storage'         => Storage::class,
        'Str'             => Str::class,
        'URL'             => URL::class,
        'Validator'       => Validator::class,
        'View'            => View::class,
    ],
];
