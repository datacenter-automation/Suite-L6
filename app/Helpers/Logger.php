<?php

namespace App\Helpers;

use App\Models\Logger as LoggerModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Request;

class Logger
{

    /**
     * @return mixed
     */
    public static function add()
    {
        $route = explode('@', Route::getCurrentRoute()->getActionName());

        $controller = $route[0];
        $action = $route[1];
        $params = Request::all();
        $headers = getallheaders();
        $username = Auth::user()->email ?? 'Guest';

        $log = new LoggerModel;
        $log->controller = $controller;
        $log->action = $action;
        $log->parameter = json_encode($params);
        $log->headers = json_encode($headers);
        $log->origin_ip_address = Request::ip();
        $log->user = $username;
        $log->method = \Request::getMethod();
        $log->save();

        return $log->id;
    }
}
