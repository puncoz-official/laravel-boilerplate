<?php

namespace App\Enums;

/**
 * Class Pagination
 *
 * @package App\Enums
 */
enum Pagination: int
{
    case PAGINATE_XXS = 5;
    case PAGINATE_XS = 10;
    case PAGINATE_SM = 15;
    case PAGINATE_MD = 25;
    case PAGINATE_LG = 50;
    case PAGINATE_XL = 75;
    case PAGINATE_XXL = 100;

    public static function default(): int
    {
        return self::PAGINATE_MD->value;
    }
}
