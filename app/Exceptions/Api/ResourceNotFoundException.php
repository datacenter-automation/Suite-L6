<?php

namespace App\Exceptions\Api;

class ResourceNotFoundException extends BaseException
{

    protected $code = 404;

    protected $message = 'Not Found';
}
