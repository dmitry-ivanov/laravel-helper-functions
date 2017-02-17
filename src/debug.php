<?php

if (!function_exists('backtrace_as_string')) {
    function backtrace_as_string()
    {
        ob_start();

        debug_print_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS);
        $backtrace = ob_get_contents();

        ob_end_clean();

        return $backtrace;
    }
}

if (!function_exists('minimized_backtrace_as_string')) {
    function minimized_backtrace_as_string()
    {
        $minimized = [];

        $backtrace = backtrace_as_string();
        $backtrace = explode("\n", $backtrace);
        foreach ($backtrace as $item) {
            if (preg_match('/(#\d+) .*? called at \[(.*?)\]/', $item, $matches)) {
                $minimized[] = $matches[1] . ' ' . $matches[2];
            }
        }

        return implode("\n", $minimized);
    }
}
