<?php

namespace Illuminated\Helpers\HelperFunctions\Tests;

use Mockery;
use Illuminated\Testing\TestingTools;
use Mockery\Adapter\Phpunit\MockeryPHPUnitIntegration;

Mockery::globalHelpers();

abstract class TestCase extends \PHPUnit\Framework\TestCase
{
    use TestingTools;
    use MockeryPHPUnitIntegration;

    public static $functions;

    protected function setUp()
    {
        self::$functions = mock();
    }

    protected function emulateLinuxOs()
    {
        self::$functions->expects()->php_uname()
            ->andReturns('Linux localhost 2.4.21-0.13mdk #1 Fri Mar 14 15:08:06 EST 2003 i686');
    }

    protected function emulateWindowsOs()
    {
        self::$functions->expects()->php_uname()
            ->andReturns('Windows NT XN1 5.1 build 2600');
    }

    protected function expectsExecWith($command)
    {
        self::$functions->expects()->exec($command);
    }
}
