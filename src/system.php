<?php

if (!function_exists('is_windows_os')) {
    function is_windows_os()
    {
        return (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN');
    }
}
