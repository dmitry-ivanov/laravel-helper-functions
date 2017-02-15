<?php

use Illuminated\Testing\TestingTools;

abstract class TestCase extends \PHPUnit\Framework\TestCase
{
    use TestingTools;

    public static $functions;

    protected function setUp()
    {
        self::$functions = Mockery::mock();
    }

    protected function shouldReceiveExecCallOnceWith($with)
    {
        self::$functions->shouldReceive('exec')->with($with)->once();
    }

    protected function tearDown()
    {
        Mockery::close();
    }
}
