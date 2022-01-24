<?php

namespace App\Infrastructure\Support\DataTransferObject;

use Illuminate\Support\Facades\Validator;
use InvalidArgumentException;

/**
 * Class DataTransferObject
 *
 * @package App\Infrastructure\Support\DataTransferObject
 */
abstract class DataTransferObject implements DtoInterface
{
    public function __construct(array $data)
    {
        $validator = Validator::make($data, $this->validationRules());

        if ( $validator->fails() ) {
            throw new InvalidArgumentException('Error: '.$validator->errors()->first());
        }

        $this->map($data);
    }

    protected function validationRules(): array
    {
        return [];
    }

    abstract protected function map(array $data): void;
}
