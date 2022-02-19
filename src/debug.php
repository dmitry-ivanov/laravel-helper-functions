<?php

if (!function_exists('backtrace_as_string')) {
    /**
     * Get backtrace without arguments, as a string.
     *
     * @return string
     */
    function backtrace_as_string()
    {
        ob_start();

        debug_print_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS);

        return ob_get_clean();
    }
}

if (!function_exists('minimized_backtrace_as_string')) {
    /**
     * Get minimized backtrace, as a string.
     *
     * @return string
     */
    function minimized_backtrace_as_string()
    {
        $backtrace = explode("\n", backtrace_as_string());

        return collect($backtrace)
            ->map(function (string $line) {
                return preg_match('/(#\d+) .*? called at \[(.*?)]/', $line, $matches) || preg_match('/(#\d+) (.*?):/', $line, $matches)
                    ? "{$matches[1]} {$matches[2]}"
                    : false;
            })
            ->filter()
            ->implode("\n");
    }
}
