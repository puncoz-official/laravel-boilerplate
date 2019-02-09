<?php

namespace App\Domain\Auth\Controllers;

use App\Constants\DBTable;
use App\Core\BaseClasses\Controllers\Controller;
use App\Data\Entities\Models\User\User;
use App\Domain\Auth\Services\Users\UserService;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Validator;

/**
 * Class RegisterController
 * @package App\Domain\Auth\Controllers
 */
class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * @var UserService
     */
    protected $userService;

    /**
     * Create a new controller instance.
     *
     * @param UserService $userService
     */
    public function __construct(UserService $userService)
    {
        $this->middleware('guest');

        $this->redirectTo = route('back.dashboard');

        $this->userService = $userService;
    }

    /**
     * Show the application registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showRegistrationForm()
    {
        return view('auth.modules.register.index');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array $data
     *
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        $usersTable = DBTable::AUTH_USERS;

        return Validator::make(
            $data,
            [
                'email'    => ['required', 'string', 'email', 'max:150', "unique:{$usersTable}"],
                'username' => ['required', 'string', 'max:100', "unique:{$usersTable}"],
                'password' => ['required', 'string', 'min:6', 'confirmed'],
            ]
        );
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array $data
     *
     * @return User
     */
    protected function create(array $data): User
    {
        $data = [
            'username'  => array_get($data, 'username'),
            'email'     => array_get($data, 'email'),
            'password'  => array_get($data, 'password'),
            'full_name' => [
                'first_name' => array_get($data, 'first_name'),
                'last_name'  => array_get($data, 'last_name'),
            ],
        ];

        return $this->userService->register($data);
    }
}
