<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\Email;
use Spatie\Honeypot\ProtectAgainstSpam;
use williamcruzme\FCM\Facades\Device;

! in_array(request()->ip(), ['127.0.0.1', '216.80.104.45']) ? abort(401, 'IP address not on host whitelist.') : true;

Route::view('/', 'welcome');

Device::routes();

Route::middleware(ProtectAgainstSpam::class)->group(function () {
    // Authentication Routes...
    Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
    Route::post('login', 'Auth\LoginController@login');
    Route::post('logout', 'Auth\LoginController@logout')->name('logout');

    // Passwordless Login Routes...
    Route::post('login/attempt', 'Auth\LoginController@attempt')->name('login.attempt');
    Route::get('login/{token}/validate', 'Auth\LoginController@login')->name('login.token.validate')->middleware('signed');

    // Lock/Unlock Routes...
    Route::get('login/locked', 'Auth\LoginController@locked')->middleware('auth')->name('login.locked');
    Route::post('login/locked', 'Auth\LoginController@unlock')->name('login.unlock');

    // Registration Routes...
    Route::get('register', function () {
        abort(500, 'Registration has been disabled.');
    })->name('register');
    Route::post('register', function () {
        abort(500, 'Registration has been disabled.');
    });

    // Password Reset Routes...
    Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
    Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
    Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
    Route::post('password/reset', 'Auth\ResetPasswordController@reset')->name('password.update');

    // Password Confirmation Routes...
    Route::get('password/confirm', 'Auth\ConfirmPasswordController@showConfirmForm')->name('password.confirm');
    Route::post('password/confirm', 'Auth\ConfirmPasswordController@confirm');

    // Email Verification Routes...
    Route::get('email/verify', 'Auth\VerificationController@show')->name('verification.notice');
    Route::get('email/verify/{id}/{hash}', 'Auth\VerificationController@verify')->name('verification.verify');
    Route::post('email/resend', 'Auth\VerificationController@resend')->name('verification.resend');
});

// Auth0 Login Route...
Route::get('/auth0/callback', '\Auth0\Login\Auth0Controller@callback')->name('auth0-callback');
//Route::get( '/login', 'Auth\Auth0IndexController@login' )->name( 'login' );
//Route::get( '/logout', 'Auth\Auth0IndexController@logout' )->name( 'logout' )->middleware('auth');

// Dashboard Routes...
Route::prefix('/dashboard')->middleware(['auth', 'auth.lock', 'auth.log', 'active_user'])->group(function () {
    Route::get('/', 'HomeController@index')->name('home');
    Route::get('/logs', 'LogController@show')->name('logs');
});

Route::get('testing0', function () {
    return Email::showMergedMessages();
});
