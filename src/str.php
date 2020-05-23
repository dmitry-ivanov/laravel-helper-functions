<?php

if (!function_exists('str_lower')) {
    /**
     * Convert string to lowercase, assuming it's in the `UTF-8` encoding.
     *
     * @param string $string
     * @return string
     *
     * @deprecated Use Illuminate\Support\Str::lower() instead.
     */
    function str_lower(string $string)
    {
        return mb_strtolower($string, 'UTF-8');
    }
}

if (!function_exists('str_upper')) {
    /**
     * Convert string to uppercase, assuming it's in the `UTF-8` encoding.
     *
     * @param string $string
     * @return string
     *
     * @deprecated Use Illuminate\Support\Str::upper() instead.
     */
    function str_upper(string $string)
    {
        return mb_strtoupper($string, 'UTF-8');
    }
}
