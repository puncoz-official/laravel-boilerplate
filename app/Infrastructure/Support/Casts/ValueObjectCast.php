<?php

namespace App\Infrastructure\Support\Casts;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Illuminate\Database\Eloquent\Model;
use InvalidArgumentException;
use ReflectionClass;
use ReflectionException;

/**
 * Class ValueObjectCast
 */
class ValueObjectCast implements CastsAttributes
{
    public function __construct(
        /** The ValueObject class to cast to */ protected string $valueObjectClass,
        /** The cast parameters specified */ protected array $parameters
    ) {
    }

    /**
     * Cast the stored value to the configured ValueObject.
     *
     * @param Model  $model
     * @param string $key
     * @param mixed  $value
     * @param array  $attributes
     *
     * @return CastableValueObject|null
     * @throws ReflectionException
     */
    public function get(Model $model, string $key, mixed $value, array $attributes)
    {
        if ( is_null($value) && in_array('nullable', $this->parameters) ) {
            $value = '{}';
        }

        if ( is_null($value) ) {
            return null;
        }

        return call_user_func_array($this->valueObjectClass.'::fromJson', [$value, $this->getJsonFlags()->decode]);
    }

    /**
     * @param Model  $model
     * @param string $key
     * @param mixed  $value
     * @param array  $attributes
     *
     * @return mixed|string|null
     * @throws ReflectionException
     */
    public function set(Model $model, string $key, mixed $value, array $attributes)
    {
        if ( is_null($value) ) {
            return null;
        }

        if ( is_array($value) ) {
            return call_user_func_array([$this->valueObjectClass, '::fromArray'], [$value]);
        }

        if ( !$value instanceof $this->valueObjectClass ) {
            throw new InvalidArgumentException("Value must be of type [$this->valueObjectClass], array, or null");
        }

        return $value->toJson($this->getJsonFlags()->encode);
    }

    /**
     * @throws ReflectionException
     */
    protected function getJsonFlags(): CastUsingJsonFlags
    {
        $attributes = (new ReflectionClass($this->valueObjectClass))->getAttributes(CastUsingJsonFlags::class);

        return ($attributes[0] ?? null)?->newInstance() ?? new CastUsingJsonFlags();
    }
}
