<?php

use Carbon\Carbon;
use Illuminate\Support\Facades\Config;

if (!function_exists('to_default_timezone')) {
    function to_default_timezone($datetime)
    {
        if (empty($datetime)) {
            return $datetime;
        }

        $timezone = Config::get('app.timezone');

        return Carbon::parse($datetime)->timezone($timezone)->toDateTimeString();
    }
}
