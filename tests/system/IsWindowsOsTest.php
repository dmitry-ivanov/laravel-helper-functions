<?php

namespace Illuminated\Helpers\System;

use Illuminated\Helpers\Tests\TestCase;
use PHPUnit\Framework\Attributes\Test;

class IsWindowsOsTest extends TestCase
{
    #[Test]
    public function it_returns_false_on_non_windows_os(): void
    {
        $this->emulateLinuxOs();

        $this->assertFalse(is_windows_os());
    }

    #[Test]
    public function it_returns_true_on_windows_os(): void
    {
        $this->emulateWindowsOs();

        $this->assertTrue(is_windows_os());
    }
}

if (!function_exists(__NAMESPACE__ . '\php_uname')) {
    /**
     * Mock for the `php_uname` function.
     */
    function php_uname(): mixed
    {
        /** @noinspection PhpUndefinedMethodInspection */
        return TestCase::$functions->php_uname();
    }
}
