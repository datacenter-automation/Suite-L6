<?php

namespace App\Traits;

use App\LoginAttempt;
use Illuminate\Http\Request;
use App\Notifications\NewLoginAttempt;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

trait PasswordlessAuth
{
    use AuthenticatesUsers;

    /**
     * Handle a login attempt request to the application.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @throws \Illuminate\Validation\ValidationException
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Symfony\Component\HttpFoundation\Response|void
     */
    public function attempt(Request $request)
    {
        $this->incrementLoginAttempts($request);

        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }

        $this->validateLogin($request);

        if ($this->createLoginAttempt($request)) {
            return $this->sendAttemptResponse($request);
        }

        return $this->sendFailedLoginResponse($request);
    }

    /**
     * Handle a login request to the application.
     *
     * @param \Illuminate\Http\Request $request
     * @param mixed                    $token
     *
     * @throws \Illuminate\Validation\ValidationException
     *
     * @return \Illuminate\Http\Response|\Symfony\Component\HttpFoundation\Response|void
     */
    public function login($token, Request $request)
    {
        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }

        if ($this->attemptLogin($token, $request)) {
            return $this->sendLoginResponse($request);
        }

        $this->incrementLoginAttempts($request);

        return $this->sendFailedLoginResponse($request);
    }

    /**
     * @param $request
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function sendAttemptResponse($request)
    {
        return \View::make('auth.link-sent');
    }

    /**
     * Attempt to log the user into the application.
     *
     * @param string                   $token
     * @param \Illuminate\Http\Request $request
     *
     * @return bool|void
     */
    protected function attemptLogin($token, Request $request)
    {
        $user = LoginAttempt::userFromToken($token);

        if (is_object($user)) {
            return $this->guard()->login($user);
        }
    }

    /**
     * Attempt to log the user into the application.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \App\LoginAttempt
     */
    protected function createLoginAttempt(Request $request)
    {
        $authorize = LoginAttempt::create([
            'email' => $request->input($this->username()),
            'token' => str_random(40) . time(),
        ]);

        $authorize->notify(new NewLoginAttempt($authorize));

        return $authorize;
    }

    /**
     * Validate the user login request.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return void
     */
    protected function validateLogin(Request $request)
    {
        $messages = ['exists' => trans('auth.exists')];

        $this->validate($request, [
            $this->username() => 'required|email|exists:users',
        ], $messages);
    }
}
