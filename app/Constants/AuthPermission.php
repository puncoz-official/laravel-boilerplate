<?php

namespace App\Constants;

/**
 * Class AuthPermission
 * @package App\Constants
 */
class AuthPermission
{
    const GLOBAL = 'global';

    const MANAGE_USER         = 'manage_user';
    const MANAGE_USER__CREATE = 'manage_user:create';
    const MANAGE_USER__READ   = 'manage_user:read';
    const MANAGE_USER__UPDATE = 'manage_user:update';
    const MANAGE_USER__DELETE = 'manage_user:delete';

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
