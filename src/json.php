<?php

if (!function_exists('is_json')) {
    /**
     * Check whether the given value is a valid JSON-encoded string or not.
     */
    function is_json(mixed $value, bool $return = false): array|bool
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
