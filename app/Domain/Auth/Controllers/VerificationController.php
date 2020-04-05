<?php

namespace App\Domain\Auth\Controllers;

use App\Core\BaseClasses\Controller\FrontOfficeController;
use App\StartUp\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\VerifiesEmails;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;

/**
 * Class VerificationController
 * @package App\Domain\Auth\Controllers
 */
class VerificationController extends FrontOfficeController
{
    /*
    |--------------------------------------------------------------------------
    | Email Verification Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling email verification for any
    | user that recently registered with the application. Emails may also
    | be re-sent if the user didn't receive the original email message.
    |
    */

    use VerifiesEmails;

    /**
     * Where to redirect users after verification.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::FRONT_OFFICE;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('signed')->only('verify');
        $this->middleware('throttle:6,1')->only('verify', 'resend');
    }

    /**
     * Show the email verification notice.
     *
     * @param Request $request
     *
     * @return RedirectResponse|Redirector
     */
    public function show(Request $request)
    {
        return $request->user()->hasVerifiedEmail() ? redirect($this->redirectPath()) : view('auth.modules.verification.index');
    }
}
