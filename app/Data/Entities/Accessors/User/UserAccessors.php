<?php

namespace App\Data\Entities\Accessors\User;

/**
 * Trait UserAccessors
 * @package App\Data\Entities\Accessors\User
 */
trait UserAccessors
{
    /**
     * @return string
     */
    public function getDisplayNameAttribute(): string
    {
        if ( $this->full_name ) {
            return trim(collect($this->full_name)->implode(' '));
        }

        if ( $this->username ) {
            return $this->username;
        }

        return $this->email;
    }
}
