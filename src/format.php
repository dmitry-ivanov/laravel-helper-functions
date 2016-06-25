<?php

if (!function_exists('format_bytes')) {
    function format_bytes($bytes, $precision = 2)
    {
        $units = ['B', 'kB', 'MB', 'GB', 'TB'];

        $maxFactor = count($units) - 1;
        $factor = floor(((strlen($bytes) - 1) / 3));
        $factor = ($factor > $maxFactor) ? $maxFactor : $factor;

        return round(($bytes / pow(1024, $factor)), $precision) . $units[$factor];
    }
}
