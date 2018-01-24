<?php

namespace Illuminated\Helpers\HelperFunctions\Tests;

use Illuminated\Testing\TestingTools;
use Mockery;
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

    protected function expectsExecWith($command)
    {
        self::$functions->expects()->exec($command);
    }
}
