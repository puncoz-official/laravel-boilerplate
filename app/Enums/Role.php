<?php

namespace App\Enums;

use App\Infrastructure\Support\EnumHelper;

/**
 * Class Role
 */
enum Role: string
{
    use EnumHelper;

    case ADMIN = 'admin';
    case USER = 'user';
}
