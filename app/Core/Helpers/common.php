<?php

if ( !function_exists('array_except_by_value') ) {
    /**
     * @param array  $array
     * @param string $value
     *
     * @return array
     */
    function array_except_by_value(array $array, string $value): array
    {
        unset($array[array_search($value, $array)]);

        return array_values($array);
    }
}
