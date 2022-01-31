<?php

namespace App\Domain\Users\Actions\Profile;

use App\Domain\Users\DTO\FullNameDto;
use App\Domain\Users\Models\User;
use App\Domain\Users\Repositories\UsersRepository;
use App\Enums\DBTables;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\UpdatesUserProfileInformation;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileDoesNotExist;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileIsTooBig;

/**
 * Class UpdateUserProfileInformation
 *
 * @package App\Domain\Users\Actions\Profile
 */
class UpdateUserProfileInformation implements UpdatesUserProfileInformation
{
    /**
     * Validate and update the given user's profile information.
     *
     * @param User  $user
     * @param array $input
     *
     * @return void
     * @throws FileDoesNotExist
     * @throws FileIsTooBig
     */
    public function update($user, array $input)
    {
        $uploadSizeLimit = config('config.max-upload-size.profile_picture');

        Validator::make($input, [
            'first_name'  => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'last_name'   => 'nullable|string|max:255',
            'email'       => ['required', 'email', 'max:255', Rule::unique(DBTables::AUTH_USERS)->ignore($user->id)],
            'photo'       => "nullable|mimes:jpg,jpeg,png|max:{$uploadSizeLimit}",
        ])->validateWithBag('updateProfileInformation');

        if ( isset($input['photo']) ) {
            $user->addMedia($input['photo'])->toMediaCollection(User::PROFILE_PICTURE);
        }

        $updateData = [
            'full_name' => FullNameDto::fromArray($input),
            'email'     => $input['email'],
        ];

        $needEmailVerification = $input['email'] !== $user->email && $user instanceof MustVerifyEmail;
        if ( $needEmailVerification ) {
            $updateData['email_verified_at'] = null;
        }

        app(UsersRepository::class)->update($updateData, $user->id);

        if ( $needEmailVerification ) {
            $user->sendEmailVerificationNotification();
        }

        session()->flash('success', trans('general.messages.success'));
    }
}
