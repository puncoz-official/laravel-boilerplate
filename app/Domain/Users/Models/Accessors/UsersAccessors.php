<?php

namespace App\Domain\Users\Models\Accessors;

use App\Domain\Users\Models\User;

/**
 * Trait UsersAccessors
 *
 * @package App\Domain\Users\Models\Accessors
 */
trait UsersAccessors
{
    /**
     * @return bool
     */
    public function getIsEmailVerifiedAttribute(): bool
    {
        return $this->email_verified_at !== null;
    }

    public function getAvatarAttribute(): string
    {
        $profilePicture = $this->getFirstMedia(User::PROFILE_PICTURE);

        if ( !$profilePicture ) {
            return $this->profile_photo_url;
        }

        return $profilePicture->getUrl('thumb');
    }
}
