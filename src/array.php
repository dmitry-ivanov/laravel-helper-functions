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

if (!function_exists('array_order_by')) {
    function array_order_by(array $array, $field1 = null, $sort1 = null, $_ = null)
    {
        $args = func_get_args();

        $data = array_shift($args);
        foreach ($args as $argKey => $argValue) {
            if (is_string($argValue)) {
                $column = [];
                foreach ($data as $key => $item) {
                    $column[$key] = $item[$argValue];
                }
                $args[$argKey] = $column;
            }
        }
        $args[] = &$data;
        call_user_func_array('array_multisort', $args);

        return array_pop($args);
    }
}
