<?php

namespace App\Domain\Users\Models\Accessors;

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
}
