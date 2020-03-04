<?php

namespace Illuminated\Helpers\Tests;

use Illuminated\Testing\TestingTools;
use Mockery;
use Mockery\Adapter\Phpunit\MockeryPHPUnitIntegration;

Mockery::globalHelpers();

abstract class TestCase extends \PHPUnit\Framework\TestCase
{
    use TestingTools;
    use MockeryPHPUnitIntegration;

    /**
     * The mock for function calls.
     *
     * @var \Mockery\MockInterface
     */
    public static $functions;

    /**
     * This method is called before each test.
     *
     * @return void
     */
    protected function setUp(): void
    {
        self::$functions = mock();
    }

    /**
     * Emulate that test runs on Linux OS.
     *
     * @return void
     */
    protected function emulateLinuxOs()
    {
        self::$functions->expects('php_uname')
            ->andReturns('Linux localhost 2.4.21-0.13mdk #1 Fri Mar 14 15:08:06 EST 2003 i686');
    }

    /**
     * Emulate that test runs on Windows OS.
     *
     * @return void
     */
    protected function emulateWindowsOs()
    {
        self::$functions->expects('php_uname')
            ->andReturns('Windows NT XN1 5.1 build 2600');
    }

    /**
     * Mock the `exec` call with the given command.
     *
     * @param string $command
     * @return void
     */
    protected function expectsExecWith(string $command)
    {
        self::$functions->expects('exec')
            ->with($command);
    }
}
