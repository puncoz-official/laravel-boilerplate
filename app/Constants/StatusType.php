<?php

namespace App\Constants;

/**
 * Class StatusType
 * @package App\Constants
 */
class StatusType
{
    const UNVERIFIED  = 'unverified';
    const VERIFIED    = 'verified';
    const DEACTIVATED = 'deactivated';
    const BLOCKED     = 'blocked';

    /**
     * Status for User profile
     *
     * @return array
     */
    public static function getUserStatus(): array
    {
        return [
            self::UNVERIFIED,
            self::VERIFIED,
            self::DEACTIVATED,
            self::BLOCKED,
        ];
    }
}
