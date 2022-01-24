<?php

namespace App\Domain\Users\Enums;

/**
 * enum Roles
 *
 * @package App\Domain\Users\Enums
 */
enum Roles: string
{
    case SUPER_ADMIN = 'super_admin';
    case USER = 'user';
}
