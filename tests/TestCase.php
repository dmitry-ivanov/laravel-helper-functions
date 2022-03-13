<?php

namespace Illuminated\Helpers\Tests;

use Illuminated\Testing\TestingTools;
use Mockery;
use Mockery\Adapter\Phpunit\MockeryPHPUnitIntegration;
use Mockery\MockInterface;

Mockery::globalHelpers();

abstract class TestCase extends \PHPUnit\Framework\TestCase
{
    use TestingTools;
    use MockeryPHPUnitIntegration;

    /**
     * The mock for function calls.
     */
    public static MockInterface $functions;

    /**
     * This method is called before each test.
     */
    protected function setUp(): void
    {
        self::$functions = mock();
    }

    /**
     * Emulate that test runs on Linux OS.
     */
    protected function emulateLinuxOs(): void
    {
        self::$functions->expects('php_uname')
            ->andReturns('Linux localhost 2.4.21-0.13mdk #1 Fri Mar 14 15:08:06 EST 2003 i686');
    }

    /**
     * Emulate that test runs on Windows OS.
     */
    protected function emulateWindowsOs(): void
    {
        self::$functions->expects('php_uname')
            ->andReturns('Windows NT XN1 5.1 build 2600');
    }

    /**
     * Mock the `exec` call with the given command.
     */
    protected function expectsExecWith(string $command): void
    {
        self::$functions->expects('exec')
            ->with($command);
    }
}
