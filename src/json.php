<?php

if (!function_exists('is_json')) {
    function is_json($string, $return = false)
    {
        if (!is_string($string)) {
            return false;
        }

        $data = json_decode($string);
        if (json_last_error() != JSON_ERROR_NONE) {
            return false;
        }

        return ($return ? $data : true);
    }
}
