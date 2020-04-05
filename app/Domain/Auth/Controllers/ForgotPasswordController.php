<?php

namespace App\Domain\Auth\Controllers;

use App\Core\BaseClasses\Controller\FrontOfficeController;
use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\View\View;

/**
 * Class ForgotPasswordController
 * @package App\Domain\Auth\Controllers
 */
class ForgotPasswordController extends FrontOfficeController
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get the response for a failed password reset link.
     *
     * Even if user not found with provided email, success message returned
     * for security and privacy reason.
     *
     * @param Request $request
     * @param string  $response
     *
     * @return RedirectResponse|JsonResponse
     */
    protected function sendResetLinkFailedResponse(Request $request, $response)
    {
        if ( $response === Password::INVALID_USER ) {
            flash()->success(trans('passwords.sent'));

            return back();
        }

        flash()->error(trans($response));

        return back()->withInput($request->only('email'));
    }

    /**
     * Get the response for a successful password reset link.
     *
     * @param Request $request
     * @param string  $response
     *
     * @return RedirectResponse|JsonResponse
     */
    protected function sendResetLinkResponse(Request $request, $response)
    {
        flash()->success(trans('passwords.sent'));

        return back();
    }

    /**
     * Display the form to request a password reset link.
     *
     * @return Factory|View
     */
    public function showLinkRequestForm()
    {
        return view('auth.modules.password.forget');
    }

    /**
     * Validate the email for the given request.
     *
     * @param Request $request
     *
     * @return void
     */
    protected function validateEmail(Request $request)
    {
        $request->validate(
            [
                'email' => 'required|email',
            ],
            [
                'email.required' => 'Please enter your registered email address.',
            ]
        );
    }
}
