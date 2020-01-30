<?php

return [
    'company_name' => env('COMPANY_NAME'),

    /*
    |--------------------------------------------------------------------------
    | Default admin user
    |--------------------------------------------------------------------------
    |
    | Default user will be created at project installation/deployment
    |
    */

    'admin_name'     => env('ADMIN_NAME', ''),
    'admin_email'    => env('ADMIN_EMAIL', ''),
    'admin_password' => env('ADMIN_PASSWORD', ''),
];
