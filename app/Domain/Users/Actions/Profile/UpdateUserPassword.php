<?php

namespace App\Domain\Users\Actions\Profile;

use App\Domain\Users\Models\User;
use App\Domain\Users\Repositories\UsersRepository;
use App\Domain\Users\Rules\PasswordValidationRules;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\UpdatesUserPasswords;

/**
 * Class UpdateUserPassword
 *
 * @package App\Domain\Users\Actions\Profile
 */
class UpdateUserPassword implements UpdatesUserPasswords
{
    use PasswordValidationRules;

    /**
     * Validate and update the user's password.
     *
     * @param User  $user
     * @param array $input
     *
     * @return void
     */
    public function update($user, array $input)
    {
        Validator::make($input, [
            'current_password' => 'required|string',
            'password'         => $this->passwordRules(),
        ])->after(function ($validator) use ($user, $input) {
            if ( !isset($input['current_password']) || !Hash::check($input['current_password'], $user->password) ) {
                $validator->errors()->add(
                    'current_password',
                    trans('passwords.current-password-mismatched')
                );
            }
        })->validateWithBag('updatePassword');

        app(UsersRepository::class)->update([
            'password' => $input['password'],
        ], $user->id);

        session()->flash('success', trans('general.messages.success'));
    }
}
