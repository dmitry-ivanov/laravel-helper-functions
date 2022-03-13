<?php

use Illuminate\Support\Arr;

if (!function_exists('array_except_value')) {
    /**
     * Remove the given values from the array.
     */
    function array_except_value(array $array, mixed $except): array
    {
        if (!is_array($except)) {
            $except = [$except];
        }

        return collect($array)
            ->reject(function ($item) use ($except) {
                return collect($except)->containsStrict($item);
            })
            ->toArray();
    }
}

if (!function_exists('multiarray_set')) {
    /**
     * Set the value for each item of the multidimensional array using "dot" notation.
     */
    function multiarray_set(array &$multiarray, mixed $key, mixed $value): array
    {
        foreach ($multiarray as &$array) {
            Arr::set($array, $key, $value);
        }

        return $multiarray;
    }
}

if (!function_exists('multiarray_sort_by')) {
    /**
     * Sort the multidimensional array by several fields.
     *
     * Use either SORT_ASC or SORT_DESC for `sort` arguments.
     */
    function multiarray_sort_by(array $multiarray, mixed $field1 = null, mixed $sort1 = null, mixed $_ = null): array
    {
        $arguments = collect(func_get_args());

        // The first argument is always the multiarray
        $array = $arguments->shift();

        // Loop through the remaining arguments and if we see a string - it is the field name.
        // We should replace it with the "pluck", in order to pass it later to `array_multisort`.
        $arguments = $arguments
            ->map(function ($item) use ($array) {
                return is_string($item) ? Arr::pluck($array, $item) : $item;
            })
            ->toArray();

        // Add the reference to the multiarray as the final argument
        $arguments[] = &$array;

        // Do the sorting with the composed arguments
        array_multisort(...$arguments);

        // The multiarray was passed by reference, thus it would be changed
        return $array;
    }
}
