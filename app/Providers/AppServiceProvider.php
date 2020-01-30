<?php

namespace App\Providers;

use App\Repositories\CustomUserRepository;
//use Auth;
use Auth0\Login\Contract\Auth0UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\ServiceProvider;
//use Pyaesone17\Lapse\Lapse;
use App\Contracts\HttpClient;
use App\Wrappers\GuzzleWrapper;
use App\Listeners\LoggingListener;

class AppServiceProvider extends ServiceProvider
{

    /**
     * All of the container bindings that should be registered.
     *
     * @var array
     */
    public array $bindings = [
        HttpClient::class => GuzzleWrapper::class,
    ];

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //Lapse::auth(fn(Request $request) => Auth::check());
        $this->app->singleton(LoggingListener::class);

        $this->app->bind(
            Auth0UserRepository::class,
            CustomUserRepository::class
        );
    }
}
