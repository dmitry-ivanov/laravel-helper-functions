<?php

use Carbon\Carbon;
use Illuminate\Support\Facades\Config;

if (!function_exists('to_default_timezone')) {
    /**
     * Convert datetime to the default timezone (`app.timezone` config parameter).
     *
     * @param mixed $datetime
     * @return mixed
     */
    function to_default_timezone($datetime)
    {
        return empty($datetime)
            ? $datetime
            : Carbon::parse($datetime)
                ->timezone(Config::get('app.timezone'))
                ->toDateTimeString();
    }
}
