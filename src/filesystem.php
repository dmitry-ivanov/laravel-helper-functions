<?php

use Symfony\Component\Filesystem\Filesystem;

if (!function_exists('relative_path')) {
    function relative_path($to, $from)
    {
        return (new Filesystem)->makePathRelative(realpath($to), realpath($from));
    }
}
