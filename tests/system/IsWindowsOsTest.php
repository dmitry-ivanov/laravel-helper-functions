<?php

namespace Illuminated\Helpers\System;

use Illuminated\Helpers\Tests\TestCase;

class IsWindowsOsTest extends TestCase
{
    /** @test */
    public function it_returns_false_on_non_windows_os()
    {
        $this->emulateLinuxOs();

        $this->assertFalse(is_windows_os());
    }

    /** @test */
    public function it_returns_true_on_windows_os()
    {
        $this->emulateWindowsOs();

        $this->assertTrue(is_windows_os());
    }
}

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
