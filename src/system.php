<?php

use Illuminated\Helpers\System\OS;

if (!function_exists('is_windows_os')) {
    /**
     * Check whether the operating system is Windows or not.
     *
     * @return bool
     */
    function is_windows_os()
    {
        return OS::isWindows();
    }
}
