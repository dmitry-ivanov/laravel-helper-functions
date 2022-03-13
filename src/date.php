<?php

use Carbon\Carbon;
use Illuminate\Support\Facades\Config;

if (!function_exists('to_default_timezone')) {
    /**
     * Convert the given datetime to the default timezone (see `app.timezone` config).
     */
    function to_default_timezone(mixed $datetime): mixed
    {
        return empty($datetime)
            ? $datetime
            : Carbon::parse($datetime)
                ->timezone(Config::get('app.timezone'))
                ->toDateTimeString();
    }
}
