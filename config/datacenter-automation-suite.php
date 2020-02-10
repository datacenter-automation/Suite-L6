<?php

return [
    'company_name' => env('COMPANY_NAME', null),

    /*
    |--------------------------------------------------------------------------
    | Default admin user
    |--------------------------------------------------------------------------
    |
    | Default user will be created at project installation/deployment
    |
    */

    'admin_name'     => env('ADMIN_NAME', null),
    'admin_email'    => env('ADMIN_EMAIL', null),
    'admin_password' => env('ADMIN_PASSWORD', null),
];
