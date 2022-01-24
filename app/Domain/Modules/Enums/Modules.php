<?php

namespace App\Domain\Modules\Enums;

/**
 * Class Modules
 *
 * @package App\Domain\Modules\Enums
 */
enum Modules: string
{
    case DASHBOARD = 'dashboard';

    public const ABILITIES = [
        'dashboard' => [
            Abilities::VIEW,
        ],
    ];

    public static function getAbilitiesByName(string $name): array
    {
        return self::ABILITIES[$name] ?? [];
    }
}
