<?php

namespace App\Domain\Auth\Controllers;

use App\Core\BaseClasses\Controller\FrontOfficeController;
use App\StartUp\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\ConfirmsPasswords;

/**
 * Class ConfirmPasswordController
 * @package App\Domain\Auth\Controllers
 */
class ConfirmPasswordController extends FrontOfficeController
{
    /*
    |--------------------------------------------------------------------------
    | Confirm Password Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password confirmations and
    | uses a simple trait to include the behavior. You're free to explore
    | this trait and override any functions that require customization.
    |
    */

    use ConfirmsPasswords;

    /**
     * Where to redirect users when the intended url fails.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
}
