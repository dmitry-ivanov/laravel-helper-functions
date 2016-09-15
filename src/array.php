<?php

if (!function_exists('array_except_value')) {
    function array_except_value(array $array, $value)
    {
        if (!is_array($value)) {
            $value = [$value];
        }

        foreach ($value as $item) {
            while (($key = array_search($item, $array, true)) !== false) {
                unset($array[$key]);
            }
        }

        return $array;
    }
}
