<?php

namespace App\Domain\Auth\Controllers;

use App\Core\BaseClasses\Controller\FrontOfficeController;
use App\StartUp\Providers\RouteServiceProvider;
use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

/**
 * Class LoginController
 * @package App\Domain\Auth\Controllers
 */
class LoginController extends FrontOfficeController
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
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
        $this->middleware('guest')->except('logout');
    }

    /**
     * Show the application's login form.
     *
     * @return Factory|View
     */
    public function showLoginForm()
    {
        return view('auth.modules.login.index');
    }

    /**
     * Get the needed authorization credentials from the request.
     *
     * @param Request $request
     *
     * @return array
     */
    protected function credentials(Request $request): array
    {
        return [
            $this->username() => $request->get('username'),
            'password'        => $request->get('password'),
        ];
    }

    /**
     * The user has logged out of the application.
     *
     * @param Request $request
     *
     * @return mixed
     */
    protected function loggedOut(Request $request)
    {
        return redirect()->to(route('auth.login'));
    }

    /**
     * Get the failed login response instance.
     *
     * @param Request $request
     *
     * @return void
     *
     * @throws ValidationException
     */
    protected function sendFailedLoginResponse(Request $request)
    {
        throw ValidationException::withMessages(
            [
                'login-failed' => [trans('auth.failed')],
            ]
        );
    }

    /**
     * Get the login username to be used by the controller.
     *
     * @return string
     */
    public function username(): string
    {
        return filter_var(request('username'), FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
    }

    /**
     * Validate the user login request.
     *
     * @param Request $request
     *
     * @return void
     */
    protected function validateLogin(Request $request)
    {
        $request->validate(
            [
                'username' => 'required|string',
                'password' => 'nullable|string',
            ],
            [
                'username.required' => 'Please enter your registered username or email.',
            ]
        );
    }
}
