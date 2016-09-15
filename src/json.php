<?php

if (!function_exists('is_json')) {
    function is_json($string, $return = false)
    {
        if (!is_string($string) || empty($string)) {
            return false;
        }

        $decoded = json_decode($string, true);
        if (json_last_error() != JSON_ERROR_NONE) {
            return false;
        }

        return ($return ? $decoded : true);
    }
}
