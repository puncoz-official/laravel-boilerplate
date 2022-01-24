<?php

namespace App\Domain\Users\DTO;

use App\Infrastructure\Support\DataTransferObject\DataTransferObject;
use Illuminate\Support\Arr;

/**
 * Class FullNameDto
 *
 * @package App\Domain\Users\DTO
 */
class FullNameDto extends DataTransferObject
{
    public string $firstName;
    public string $lastName;

    public function toArray(): array
    {
        return [
            'first_name' => $this->firstName,
            'last_name'  => $this->lastName,
        ];
    }

    protected function map(array $data): void
    {
        $this->firstName = Arr::get($data, 'first_name');
        $this->lastName  = Arr::get($data, 'last_name');
    }
}
