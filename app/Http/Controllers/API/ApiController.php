<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Traits\ApiRespondable;
use GDebrauwer\Hateoas\Traits\HasLinks;

class ApiController extends Controller
{

    use ApiRespondable, HasLinks;
}
