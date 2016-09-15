<?php

if (!function_exists('str_lower')) {
    function str_lower($string)
    {
        return mb_strtolower($string, 'UTF-8');
    }
}

if (!function_exists('str_upper')) {
    function str_upper($string)
    {
        return mb_strtoupper($string, 'UTF-8');
    }
}
