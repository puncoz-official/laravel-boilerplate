<?php

namespace App\Infrastructure\Support\Fractal;

use ArrayAccess;
use ArrayIterator;
use IteratorAggregate;
use LogicException;
use ReturnTypeWillChange;

/**
 * Class CustomParamBag
 *
 * @package  App\Infrastructure\Support\Fractal
 *
 * @override until theleaguephp's fractal supports php8.1
 */
class CustomParamBag implements ArrayAccess, IteratorAggregate
{
    /**
     * @var array
     */
    protected array $params = [];

    /**
     * Create a new parameter bag instance.
     *
     * @param array $params
     *
     * @return void
     */
    public function __construct(array $params)
    {
        $this->params = $params;
    }

    /**
     * Get parameter values out of the bag.
     *
     * @param string $key
     *
     * @return mixed
     */
    public function get($key)
    {
        return $this->__get($key);
    }

    /**
     * Get parameter values out of the bag via the property access magic method.
     *
     * @param string $key
     *
     * @return mixed
     */
    public function __get($key)
    {
        return isset($this->params[$key]) ? $this->params[$key] : null;
    }

    /**
     * Disallow changing the value of params in the data bag via property access.
     *
     * @param string $key
     * @param mixed  $value
     *
     * @return void
     * @throws LogicException
     *
     */
    public function __set($key, $value)
    {
        throw new LogicException('Modifying parameters is not permitted');
    }

    /**
     * Check if a param exists in the bag via an isset() check on the property.
     *
     * @param string $key
     *
     * @return bool
     */
    public function __isset($key)
    {
        return isset($this->params[$key]);
    }

    /**
     * Disallow unsetting params in the data bag via property access.
     *
     * @param string $key
     *
     * @return void
     * @throws LogicException
     *
     */
    public function __unset($key)
    {
        throw new LogicException('Modifying parameters is not permitted');
    }

    /**
     * Check if a param exists in the bag via an isset() and array access.
     *
     * @param string $key
     *
     * @return bool
     */
    #[ReturnTypeWillChange]
    public function offsetExists($key)
    {
        return $this->__isset($key);
    }

    /**
     * Get parameter values out of the bag via array access.
     *
     * @param string $key
     *
     * @return mixed
     */
    #[ReturnTypeWillChange]
    public function offsetGet($key)
    {
        return $this->__get($key);
    }

    /**
     * Disallow changing the value of params in the data bag via array access.
     *
     * @param string $key
     * @param mixed  $value
     *
     * @return void
     * @throws LogicException
     *
     */
    #[ReturnTypeWillChange]
    public function offsetSet($key, $value)
    {
        throw new LogicException('Modifying parameters is not permitted');
    }

    /**
     * Disallow unsetting params in the data bag via array access.
     *
     * @param string $key
     *
     * @return void
     * @throws LogicException
     *
     */
    #[ReturnTypeWillChange]
    public function offsetUnset($key)
    {
        throw new LogicException('Modifying parameters is not permitted');
    }

    /**
     * IteratorAggregate for iterating over the object like an array.
     *
     * @return ArrayIterator
     */
    #[ReturnTypeWillChange]
    public function getIterator()
    {
        return new ArrayIterator($this->params);
    }
}
