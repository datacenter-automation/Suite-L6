<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;

class VersionController extends Controller
{
    public function __invoke(): array
    {
        return [
            'latest'  => config('app.api_latest'),
            'current' => config('app.api_version'),
        ];
    }
}
