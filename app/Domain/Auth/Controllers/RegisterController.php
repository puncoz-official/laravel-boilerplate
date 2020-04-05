<?php

namespace App\Domain\Auth\Controllers;

use App\Constants\DBTable;
use App\Core\BaseClasses\Controller\FrontOfficeController;
use App\Data\Entities\User\User;
use App\Domain\Auth\Services\Users\UserService;
use App\StartUp\Providers\RouteServiceProvider;
use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;

/**
 * Class RegisterController
 * @package App\Domain\Auth\Controllers
 */
class RegisterController extends FrontOfficeController
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
    protected $redirectTo = RouteServiceProvider::FRONT_OFFICE;

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

        $this->userService = $userService;
    }

    /**
     * Show the application registration form.
     *
     * @return Factory|View
     */
    public function showRegistrationForm()
    {
        return view('auth.modules.register.index');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param array $data
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
     * @param array $data
     *
     * @return User
     */
    protected function create(array $data): User
    {
        $data = [
            'username'  => Arr::get($data, 'username'),
            'email'     => Arr::get($data, 'email'),
            'password'  => Arr::get($data, 'password'),
            'full_name' => [
                'first_name' => Arr::get($data, 'first_name'),
                'last_name'  => Arr::get($data, 'last_name'),
            ],
        ];

        return $this->userService->register($data);
    }
}
