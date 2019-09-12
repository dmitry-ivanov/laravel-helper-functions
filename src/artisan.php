<?php

use Illuminated\Helpers\Artisan\Command;

if (!function_exists('call_in_background')) {
    function call_in_background($command, $before = null, $after = null)
    {
        Command::factory($command, $before, $after)->runInBackground();
    }
}
