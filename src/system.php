<?php

use Illuminated\Helpers\System\OS;

if (!function_exists('is_windows_os')) {
    /**
     * Check whether the operating system is Windows or not.
     */
    function is_windows_os(): bool
    {
        return OS::isWindows();
    }
}
