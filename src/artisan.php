<?php

use Symfony\Component\Process\PhpExecutableFinder;
use Symfony\Component\Process\ProcessUtils;

if (!function_exists('call_in_background')) {
    function call_in_background($command, $before = null, $after = null)
    {
        $parts = [];
        if (!empty($before)) {
            $parts[] = $before;
        }

        $binary = ProcessUtils::escapeArgument((new PhpExecutableFinder)->find(false));
        if (defined('HHVM_VERSION')) {
            $binary .= ' --php';
        }
        $artisan = 'artisan';
        if (defined('ARTISAN_BINARY')) {
            $artisan = ProcessUtils::escapeArgument(ARTISAN_BINARY);
        }
        $parts[] = "{$binary} {$artisan} {$command}";

        if (!empty($after)) {
            $parts[] = $after;
        }

        $expression = implode(' && ', $parts);
        exec("({$expression}) > /dev/null 2>&1 &");
    }
}
