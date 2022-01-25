<?php

namespace App\Domain\Users\Actions;

use App\Domain\Users\DTO\FullNameDto;
use App\Enums\DBTables;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\UpdatesUserProfileInformation;

class UpdateUserProfileInformation implements UpdatesUserProfileInformation
{
    /**
     * Validate and update the given user's profile information.
     *
     * @param mixed $user
     * @param array $input
     *
     * @return void
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update($user, array $input)
    {
        Validator::make($input, [
            'name'  => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', Rule::unique(DBTables::AUTH_USERS)->ignore($user->id)],
            'photo' => ['nullable', 'mimes:jpg,jpeg,png', 'max:1024'],
        ])->validateWithBag('updateProfileInformation');

        if ( isset($input['photo']) ) {
            $user->updateProfilePhoto($input['photo']);
        }

        if ( $input['email'] !== $user->email &&
             $user instanceof MustVerifyEmail ) {
            $this->updateVerifiedUser($user, $input);
        }
        else {
            $user->forceFill([
                'full_name' => FullNameDto::fromString($input['name']),
                'email'     => $input['email'],
            ])->save();
        }
    }

    /**
     * Update the given verified user's profile information.
     *
     * @param mixed $user
     * @param array $input
     *
     * @return void
     */
    protected function updateVerifiedUser($user, array $input)
    {
        $user->forceFill([
            'full_name'         => FullNameDto::fromString($input['name']),
            'email'             => $input['email'],
            'email_verified_at' => null,
        ])->save();

        $user->sendEmailVerificationNotification();
    }
}
