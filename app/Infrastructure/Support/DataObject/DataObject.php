<?php

namespace App\Infrastructure\Support\DataObject;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\Support\Jsonable;
use Illuminate\Support\Facades\Validator;

/**
 * Class DataObject
 */
abstract class DataObject implements DataInterface, Arrayable, Jsonable
{
    public function __construct(array $data)
    {
        $validator = Validator::make($data, $this->rules());

        if ( $validator->fails() ) {
            throw new \InvalidArgumentException('Error: '.$validator->errors()->first());
        }

        $this->map($data);
    }

    /**
     * @param string $json
     * @param int    $options
     *
     * @return static
     */
    public static function fromJson(string $json, int $options = 0)
    {
        return new static(json_decode($json, true, 512, $options));
    }

    /**
     * @param array $array
     *
     * @return static
     */
    public static function fromArray(array $array)
    {
        return new static($array);
    }

    abstract public function map(array $data): void;

    abstract public function toArray(): array;

    /**
     * @param $options
     *
     * @return false|string
     */
    public function toJson($options = 0)
    {
        return json_encode($this->toArray(), $options);
    }

    protected function rules(): array
    {
        return [];
    }
}
