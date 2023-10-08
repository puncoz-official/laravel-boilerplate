<?php

namespace App\Domain\User\ValueObjects;

use App\Infrastructure\Support\Casts\CastableValueObject;
use Illuminate\Support\Arr;

/**
 * Class FullName
 */
class FullName extends CastableValueObject
{
    public string $firstName;
    public string $middleName;
    public string $lastName;

    public static function fromString(string $name): static
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

    /**
     * Get the instance as an array.
     *
     * @return array<string, string>
     */
    public function toArray(): array
    {
        return [
            'first_name'  => $this->firstName,
            'middle_name' => $this->middleName,
            'last_name'   => $this->lastName,
        ];
    }

    public function map(array $data): void
    {
        $this->firstName  = Arr::get($data, 'first_name');
        $this->middleName = Arr::get($data, 'middle_name');
        $this->lastName   = Arr::get($data, 'last_name');
    }
}
