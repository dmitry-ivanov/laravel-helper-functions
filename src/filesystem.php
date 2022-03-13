<?php

use Symfony\Component\Filesystem\Filesystem;

if (!function_exists('relative_path')) {
    /**
     * Get a relative path for the given folders.
     */
    function relative_path(string $to, string $from): string
    {
        return (new Filesystem)->makePathRelative(realpath($to), realpath($from));
    }
}
