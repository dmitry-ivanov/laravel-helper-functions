<?php

use Illuminated\Helpers\System\OS;

if (!function_exists('is_windows_os')) {
    function is_windows_os()
    {
        return OS::isWindows();
    }
}
