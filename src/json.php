<?php

if (!function_exists('is_json')) {
    /**
     * Check whether the given value is a valid JSON-encoded string or not.
     *
     * @param mixed $string
     * @param bool $return
     * @return bool|array
     */
    function is_json($string, bool $return = false)
    {
        if (empty($string) || !is_string($string)) {
            return false;
        }

        $decoded = json_decode($string, true);
        if (json_last_error() !== JSON_ERROR_NONE) {
            return false;
        }

        return $return ? $decoded : true;
    }
}
