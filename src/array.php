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

if (!function_exists('multiarray_sort_by')) {
    function multiarray_sort_by(array $array, $field1 = null, $sort1 = null, $_ = null)
    {
        $arguments = func_get_args();

        $multiarray = array_shift($arguments);
        foreach ($arguments as $key => $value) {
            if (is_string($value)) {
                $arguments[$key] = array_pluck($multiarray, $value);
            }
        }
        $arguments[] = &$multiarray;
        call_user_func_array('array_multisort', $arguments);

        return array_pop($arguments);
    }
}
