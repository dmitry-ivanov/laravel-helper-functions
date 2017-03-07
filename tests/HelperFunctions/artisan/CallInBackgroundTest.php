<?php

namespace Illuminated\Helpers\HelperFunctions\Tests\Artisan;

use Illuminated\Helpers\HelperFunctions\Tests\TestCase;
use Mockery;

/**
 * @runTestsInSeparateProcesses
 * @preserveGlobalState disabled
 */
class CallInBackgroundTest extends TestCase
{
    /** @test */
    public function it_works_without_optional_before_and_after_parameters()
    {
        $mock = Mockery::mock('alias:Illuminated\Helpers\Artisan\Command');
        $mock->shouldReceive('factory')->withArgs(['test command', null, null])->once()->andReturnSelf();
        $mock->shouldReceive('runInBackground')->withNoArgs()->once();

        call_in_background('test command');
    }

    /** @test */
    public function it_works_with_optional_before_parameter()
    {
        $mock = Mockery::mock('alias:Illuminated\Helpers\Artisan\Command');
        $mock->shouldReceive('factory')->withArgs(['test command', 'before command', null])->once()->andReturnSelf();
        $mock->shouldReceive('runInBackground')->withNoArgs()->once();

        call_in_background('test command', 'before command');
    }

    /** @test */
    public function it_works_with_optional_after_parameter()
    {
        $mock = Mockery::mock('alias:Illuminated\Helpers\Artisan\Command');
        $mock->shouldReceive('factory')->withArgs(['test command', null, 'after command'])->once()->andReturnSelf();
        $mock->shouldReceive('runInBackground')->withNoArgs()->once();

        call_in_background('test command', null, 'after command');
    }

    /** @test */
    public function it_works_with_optional_before_and_after_parameters_together()
    {
        $mock = Mockery::mock('alias:Illuminated\Helpers\Artisan\Command');
        $mock->shouldReceive('factory')->withArgs(['test command', 'before', 'after'])->once()->andReturnSelf();
        $mock->shouldReceive('runInBackground')->withNoArgs()->once();

        call_in_background('test command', 'before', 'after');
    }
}
