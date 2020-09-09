<?php

namespace Illuminated\Helpers\System;

use Illuminated\Helpers\Tests\TestCase;

if (!function_exists(__NAMESPACE__ . '\php_uname')) {
    /**
     * Mock for the `php_uname` function.
     *
     * @return mixed
     *
     * @noinspection PhpUndefinedMethodInspection
     */
    function php_uname()
    {
        return TestCase::$functions->php_uname();
    }
}
