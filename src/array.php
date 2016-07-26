<?php

if (!function_exists('array_except_value')) {
    function array_except_value($array, $value)
    {
        if (!is_array($value)) {
            $value = [$value];
        }

        foreach ($value as $item) {
            $key = array_search($item, $array);
            if ($key !== false) {
                unset($array[$key]);
            }
        }

        return $array;
    }
}
