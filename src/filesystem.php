<?php

use Symfony\Component\Filesystem\Filesystem;

if (!function_exists('relative_path')) {
    /**
     * Get relative path for the given folders.
     *
     * @param string $to
     * @param string $from
     * @return string
     */
    function relative_path(string $to, string $from)
    {
        return (new Filesystem)->makePathRelative(realpath($to), realpath($from));
    }
}
