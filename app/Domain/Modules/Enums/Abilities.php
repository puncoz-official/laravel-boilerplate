<?php

namespace App\Domain\Modules\Enums;

/**
 * enum Abilities
 *
 * @package App\Domain\Modules\Enums
 */
enum Abilities: string
{
    case VIEW = 'view';
    case CREATE = 'create';
    case UPDATE = 'update';
    case DELETE = 'delete';
}
