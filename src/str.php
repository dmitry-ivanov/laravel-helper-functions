<?php

use Illuminate\Support\Str;

if (!function_exists('str_lower')) {
    function str_lower($string)
    {
        return Str::lower($string);
    }
}

if (!function_exists('str_upper')) {
    function str_upper($string)
    {
        return Str::upper($string);
    }
}
