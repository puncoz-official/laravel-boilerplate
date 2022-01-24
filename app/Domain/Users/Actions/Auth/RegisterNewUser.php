<?php

namespace App\Domain\Users\Actions\Auth;

use App\Domain\Users\DTO\FullNameDto;
use App\Domain\Users\Models\User;
use App\Domain\Users\Repositories\UsersRepository;
use App\Domain\Users\Rules\PasswordValidationRules;
use App\Enums\DBTables;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;

/**
 * Class RegisterNewUser
 *
 * @package App\Domain\Users\Actions\Auth
 */
class RegisterNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param array $input
     *
     * @return User
     */
    public function create(array $input)
    {
        $usersTable = DBTables::AUTH_USER;

        Validator::make($input, [
            'full_name' => ['required', 'string', 'max:255'],
            'email'     => ['required', 'string', 'email', 'max:255', "unique:{$usersTable},email"],
            'password'  => $this->passwordRules(),
            'terms'     => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['required', 'accepted'] : '',
        ])->validate();

        return tap(
            app(UsersRepository::class)->create([
                'full_name' => FullNameDto::fromString($input['full_name']),
                'email'     => $input['email'],
                'password'  => $input['password'],
            ]),
            function (User $user) {
                $user->assignRole(Jetstream::defaultRole());
            }
        );
    }
}
