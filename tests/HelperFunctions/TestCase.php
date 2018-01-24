<?php

namespace Illuminated\Helpers\HelperFunctions\Tests;

use Illuminated\Testing\TestingTools;
use Mockery;
use Mockery\Adapter\Phpunit\MockeryPHPUnitIntegration;

abstract class TestCase extends \PHPUnit\Framework\TestCase
{
    use TestingTools;
    use MockeryPHPUnitIntegration;

    public static $functions;

    protected function setUp()
    {
        self::$functions = Mockery::mock();
    }

    protected function shouldReceiveExecCallOnceWith($with)
    {
        self::$functions->shouldReceive('exec')->with($with)->once();
    }
}
