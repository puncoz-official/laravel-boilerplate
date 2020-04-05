<?php

namespace App\Data\Entities\User;

/**
 * Trait UserAccessors
 * @package App\Data\Entities\User
 */
trait UserAccessors
{
    /**
     * @return string
     */
    public function getDisplayNameAttribute(): string
    {
        /** @var User $this */
        if ( $this->full_name ) {
            return trim(collect($this->full_name)->implode(' '));
        }

        if ( $this->username ) {
            return $this->username;
        }

        return $this->email;
    }
}
