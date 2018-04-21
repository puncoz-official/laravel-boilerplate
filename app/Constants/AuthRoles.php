<?php

namespace App\Constants;

/**
 * Class UserRoles
 * @package App\Constants
 */
class AuthRoles
{
    const SUPER_ADMIN = 'super_admin';
    const ADMIN       = 'admin';
    const GENERAL     = 'general';

    /**
     * @return array
     */
    public static function ALL(): array
    {
        try {
            $reflectionClass = new \ReflectionClass(__CLASS__);
        } catch (\ReflectionException $e) {
            return [];
        }

        return $reflectionClass->getConstants();

    }
}
