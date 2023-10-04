<?php

namespace App\Infrastructure\Support\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller;

/**
 * Class BaseController
 */
class BaseController extends Controller
{
    use AuthorizesRequests;
    use ValidatesRequests;
}
