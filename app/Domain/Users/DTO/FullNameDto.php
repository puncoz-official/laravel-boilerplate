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
    public string  $firstName;
    public ?string $middleName;
    public ?string $lastName;

    public static function fromString(string $name): self
    {
        $explodedName = explode(' ', $name);

        $firstName  = array_shift($explodedName);
        $lastName   = array_pop($explodedName) ?? '';
        $middleName = count($explodedName) ? trim(implode(' ', $explodedName)) : '';

        return new static([
            'first_name'  => $firstName,
            'middle_name' => $middleName,
            'last_name'   => $lastName,
        ]);
    }

    public static function fromArray(array $data): self
    {
        return new static([
            'first_name'  => Arr::get($data, 'first_name'),
            'middle_name' => Arr::get($data, 'middle_name'),
            'last_name'   => Arr::get($data, 'last_name'),
        ]);
    }

    public function toArray(): array
    {
        return [
            'first_name'  => $this->firstName,
            'middle_name' => $this->middleName,
            'last_name'   => $this->lastName,
        ];
    }

    public function toString(): string
    {
        $fullName = [];
        if ( $this->firstName ) {
            $fullName[] = $this->firstName;
        }

        if ( $this->middleName ) {
            $fullName[] = $this->middleName;
        }

        if ( $this->lastName ) {
            $fullName[] = $this->lastName;
        }

        return implode(' ', $fullName);
    }

    protected function map(array $data): void
    {
        $this->firstName  = Arr::get($data, 'first_name');
        $this->middleName = Arr::get($data, 'middle_name');
        $this->lastName   = Arr::get($data, 'last_name');
    }
}
