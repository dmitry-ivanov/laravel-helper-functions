<?php

namespace Illuminated\Helpers\System;

class OS
{
    /**
     * Check whether the operating system is Windows or not.
     */
    public static function isWindows(): bool
    {
        return stripos(php_uname(), 'windows') === 0;
    }
}
