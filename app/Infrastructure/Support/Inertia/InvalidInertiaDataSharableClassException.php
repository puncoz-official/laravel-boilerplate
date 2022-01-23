<?php

namespace App\Infrastructure\Support\Inertia;

use Exception;

/**
 * Class InvalidInertiaDataSharableClassException
 *
 * @package App\Infrastructure\Support\Inertia
 */
class InvalidInertiaDataSharableClassException extends Exception
{
    private const MESSAGE = "Inertia Data class should implement DataSharableInterface contract";

    /**
     * InvalidDataSharedClassException constructor.
     *
     * @param string $message
     */
    public function __construct($message = "")
    {
        parent::__construct($message ?: self::MESSAGE);
    }
}
