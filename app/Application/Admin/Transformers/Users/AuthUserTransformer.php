<?php

namespace App\Application\Admin\Transformers\Users;

use App\Application\Supports\Transformers\Medias\MediaTransformer;
use App\Domain\Users\Models\User;
use App\Infrastructure\Support\Helpers\Helper;
use League\Fractal\Resource\Item;
use League\Fractal\TransformerAbstract;

/**
 * Class AuthUserTransformer
 *
 * @package App\Application\Admin\Transformers\Users
 */
class AuthUserTransformer extends TransformerAbstract
{
    protected $defaultIncludes = ['profile_picture'];

    public function transform(User $user): array
    {
        return [
            'id'                      => $user->id,
            'full_name'               => $user->full_name->toArray(),
            'full_name_formatted'     => $user->full_name->toString(),
            'email'                   => $user->email,
            'is_email_verified'       => $user->is_email_verified,
            'created_at'              => Helper::dateResponse($user->created_at),
            'default_profile_picture' => $user->profile_photo_url,
            'two_factor_enabled'      => $user->hasEnabledTwoFactorAuthentication(),
        ];
    }

    public function includeProfilePicture(User $user): ?Item
    {
        $profilePicture = $user->getFirstMedia(User::PROFILE_PICTURE);

        if ( !$profilePicture ) {
            return null;
        }

        return $this->item($profilePicture, new MediaTransformer());
    }
}
