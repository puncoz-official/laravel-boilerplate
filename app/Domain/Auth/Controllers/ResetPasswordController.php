<?php

namespace App\Domain\Auth\Controllers;

use App\Core\BaseClasses\Controller\FrontOfficeController;
use App\StartUp\Providers\RouteServiceProvider;
use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\View\View;

/**
 * Class ResetPasswordController
 * @package App\Domain\Auth\Controllers
 */
class ResetPasswordController extends FrontOfficeController
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
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
        $this->middleware('guest');
    }

    /**
     * Get the password reset validation rules.
     *
     * @return array
     */
    protected function rules()
    {
        return [
            'token'    => 'required',
            'email'    => 'required|email',
            'password' => 'required|confirmed|min:6',
        ];
    }

    /**
     * Get the response for a failed password reset.
     *
     * @param Request $request
     * @param string  $response
     *
     * @return RedirectResponse|JsonResponse
     */
    protected function sendResetFailedResponse(Request $request, $response)
    {
        $message = trans($response);
        if ( in_array($response, [Password::INVALID_USER, Password::INVALID_TOKEN]) ) {
            $message = 'This password reset token is invalid. Either token expired or email address is not valid.';
        }

        flash()->error($message);

        return redirect()->back()->withInput($request->only('email'));
    }

    /**
     * Display the password reset view for the given token.
     *
     * If no token is present, display the link request form.
     *
     * @param Request     $request
     * @param string|null $token
     *
     * @return Factory|View
     */
    public function showResetForm(Request $request, $token = null)
    {
        return view('auth.modules.password.reset')->with(
            [
                'token' => $token,
                'email' => $request->get('email'),
            ]
        );
    }

    /**
     * Get the password reset validation error messages.
     *
     * @return array
     */
    protected function validationErrorMessages()
    {
        return [
            'email.required'    => 'Please enter your registered email address.',
            'password.required' => 'Please enter new password.',
        ];
    }
}
