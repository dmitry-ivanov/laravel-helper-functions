<?php

use Carbon\Carbon;

if (!function_exists('to_default_timezone')) {
    function to_default_timezone($datetime)
    {
        if (empty($datetime)) {
            return $datetime;
        }

        return Carbon::parse($datetime)->timezone(config('app.timezone'))->toDateTimeString();
    }
}
