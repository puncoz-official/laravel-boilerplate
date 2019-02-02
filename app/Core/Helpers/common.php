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

if ( !function_exists('getLocale') ) {
    /**
     * @return string
     */
    function getLocale(): string
    {
        return str_replace('_', '-', app()->getLocale());
    }
}

if ( !function_exists('front_mix') ) {
    /**
     * @param string $path
     *
     * @return \Illuminate\Support\HtmlString|string
     * @throws Exception
     */
    function front_mix(string $path)
    {
        return mix($path, 'assets/front-office');
    }
}

if ( !function_exists('back_mix') ) {
    /**
     * @param string $path
     *
     * @return \Illuminate\Support\HtmlString|string
     * @throws Exception
     */
    function back_mix(string $path)
    {
        return mix($path, 'assets/back-office');
    }
}

if ( !function_exists('auth_mix') ) {
    /**
     * @param string $path
     *
     * @return \Illuminate\Support\HtmlString|string
     * @throws Exception
     */
    function auth_mix(string $path)
    {
        return mix($path, 'assets/auth');
    }
}
