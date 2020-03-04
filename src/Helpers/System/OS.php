<?php

namespace Illuminated\Helpers\System;

class OS
{
    /**
     * Check whether the operating system is Windows or not.
     *
     * @return bool
     */
    public static function isWindows()
    {
        return stripos(php_uname(), 'windows') === 0;
    }
}
