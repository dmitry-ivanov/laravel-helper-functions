<?php

if (!function_exists('is_json')) {
    /**
     * Check whether the given value is a valid JSON-encoded string or not.
     *
     * @param mixed $value
     * @param bool $return
     * @return bool|array
     */
    function is_json($value, bool $return = false)
    {
        if (empty($value) || !is_string($value)) {
            return false;
        }

        $decoded = json_decode($value, true);
        if (json_last_error() !== JSON_ERROR_NONE) {
            return false;
        }

        return $return ? $decoded : true;
    }
}
