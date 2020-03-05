<?php

namespace App\Exceptions;

use Throwable;
use Exception;
use App\Listeners\LoggingListener;
//use Pyaesone17\Lapse\ErrorNotifiable;
use Illuminate\Support\ViewErrorBag;
use Illuminate\Support\Facades\Storage;
use Illuminate\Log\Events\MessageLogged;
use Spatie\Permission\Exceptions\UnauthorizedException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Illuminate\Routing\Exceptions\InvalidSignatureException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;

class Handler extends ExceptionHandler
{

    //use ErrorNotifiable;

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [];

    /**
     * The unique incident ID code
     *
     * @var string|bool
     */
    protected $incidentCode = false;

    /**
     * Render an exception into an HTTP response.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Response
     */
    public function render($request, Throwable $exception)
    {
        if ($exception instanceof UnauthorizedException) {
            return response()->json([
                'responseMessage' => 'You do not have the required authorization.',
                'responseStatus'  => 403,
            ]);
        }

        if ($exception instanceof InvalidSignatureException) {
            return response()->view('auth.signature-expired');
        }

        if (app()->bound('honeybadger') && $this->shouldReport($exception)) {
            app('honeybadger')->notify($exception, app('request'));
        }

        return parent::render($request, $exception);
    }

    /**
     * Report or log an exception.
     *
     * @param  \Throwable  $exception
     *
     * @throws \Throwable
     *
     * @return void
     */
    public function report(Throwable $exception)
    {
        if (app()->bound('honeybadger') && $this->shouldReport($exception)) {
            app('honeybadger')->notify($exception, app('request'));
        }

        $this->incidentCode = str_random();

        $listener = $this->container->make(LoggingListener::class);

        $listener->events->map(function (MessageLogged $logged) {
            $logged->context = collect($logged->context)->map(function ($item) {
                if ($item instanceof \JsonSerializable) {
                    return $item;
                }

                return (string) $item;
            });

            return $logged;
        });

        Storage::disk('local')->put("incident\\{$this->incidentCode}.json", $listener->events->toJson(JSON_PRETTY_PRINT));

        //$this->sendNotification($exception);

        parent::report($exception);
    }

    /**
     * Render the given HttpException.
     *
     * @param \Symfony\Component\HttpKernel\Exception\HttpExceptionInterface $e
     *
     * @return \Illuminate\Http\Response|\Symfony\Component\HttpFoundation\Response
     */
    protected function renderHttpException(HttpExceptionInterface $e)
    {
        $this->registerErrorViewPaths();

        if (view()->exists($view = "errors::{$e->getStatusCode()}")) {
            return response()->view($view, [
                'errors'       => new ViewErrorBag,
                'exception'    => $e,
                'incidentCode' => $this->incidentCode ?? false,
            ], $e->getStatusCode(), $e->getHeaders());
        }

        return $this->convertExceptionToResponse($e);
    }
}
