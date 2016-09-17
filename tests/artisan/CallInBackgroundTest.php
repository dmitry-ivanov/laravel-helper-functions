<?php

use Mockery as m;

// /**
//  * @runTestsInSeparateProcesses
//  * @preserveGlobalState disabled
//  */
class CallInBackgroundTest extends TestCase
{
    /** @test */
    public function it_works_without_before_and_after_parameters()
    {
        $mock = m::mock('alias:Illuminated\Helpers\Artisan\Command');
        $mock->shouldReceive('factory')->withArgs(['test command', null, null])->once()->andReturnSelf();
        $mock->shouldReceive('runInBackground')->withNoArgs()->once();

        call_in_background('test command');
    }

    /** @test */
    public function it_works_with_only_before_parameter()
    {
        $mock = m::mock('alias:Illuminated\Helpers\Artisan\Command');
        $mock->shouldReceive('factory')->withArgs(['test command', 'before command', null])->once()->andReturnSelf();
        $mock->shouldReceive('runInBackground')->withNoArgs()->once();

        call_in_background('test command', 'before command');
    }

    /** @test */
    public function it_works_with_only_after_parameter()
    {
        $mock = m::mock('alias:Illuminated\Helpers\Artisan\Command');
        $mock->shouldReceive('factory')->withArgs(['test command', null, 'after command'])->once()->andReturnSelf();
        $mock->shouldReceive('runInBackground')->withNoArgs()->once();

        call_in_background('test command', null, 'after command');
    }

    /** @test */
    public function it_works_with_before_and_after_parameters()
    {
        $mock = m::mock('alias:Illuminated\Helpers\Artisan\Command');
        $mock->shouldReceive('factory')->withArgs(['test command', 'before', 'after'])->once()->andReturnSelf();
        $mock->shouldReceive('runInBackground')->withNoArgs()->once();

        call_in_background('test command', 'before', 'after');
    }
}
