<?php

namespace App\Enums;

/**
 * enum General
 *
 * @package App\Enums
 */
enum General: string
{
    case DATE_FORMAT = 'Y/m/d';

    case IMAGE_SIZE_THUMB = "150";
    case IMAGE_SIZE_SMALL = "300";
    case IMAGE_SIZE_MEDIUM = "600";
    case IMAGE_SIZE_LARGE = "1000";
}
