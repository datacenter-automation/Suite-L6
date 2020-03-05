<?php

namespace App\Http\Controllers\API;

use App\Traits\ApiRespondable;
use App\Http\Controllers\Controller;
use GDebrauwer\Hateoas\Traits\HasLinks;

class ApiController extends Controller
{
    use ApiRespondable, HasLinks;
}
