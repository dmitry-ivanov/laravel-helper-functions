<?php

use Mockery as m;

// /**
//  * @runTestsInSeparateProcesses
//  * @preserveGlobalState disabled
//  */
class CallInBackgroundTest extends TestCase
{
    protected function setUp()
    {
        $phpMock = m::mock('overload:Symfony\Component\Process\PhpExecutableFinder');
        $phpMock->shouldReceive('find')->with(false)->once()->andReturn('php');

        $utilsMock = m::mock('alias:Symfony\Component\Process\ProcessUtils');
        $utilsMock->shouldReceive('escapeArgument')->withAnyArgs()->atLeast()->once()->andReturnUsing(function ($v) {
            return $v;
        });
    }

    /** @test */
    public function it_works_without_before_and_after_parameters()
    {
        $mock = m::mock('alias:Illuminated\Helpers\System\Command');
        $mock->shouldReceive('exec')->with('(php artisan test command) > /dev/null 2>&1 &')->once();

        call_in_background('test command');
    }

    /** @test */
    public function it_works_with_only_before_parameter()
    {
        $mock = m::mock('alias:Illuminated\Helpers\System\Command');
        $mock->shouldReceive('exec')->with('(before command && php artisan test command) > /dev/null 2>&1 &')->once();

        call_in_background('test command', 'before command');
    }

    /** @test */
    public function it_works_with_only_after_parameter()
    {
        $mock = m::mock('alias:Illuminated\Helpers\System\Command');
        $mock->shouldReceive('exec')->with('(php artisan test command && after command) > /dev/null 2>&1 &')->once();

        call_in_background('test command', null, 'after command');
    }

    /** @test */
    public function it_works_with_before_and_after_parameters()
    {
        $mock = m::mock('alias:Illuminated\Helpers\System\Command');
        $mock->shouldReceive('exec')->with('(before && php artisan test command && after) > /dev/null 2>&1 &')->once();

        call_in_background('test command', 'before', 'after');
    }
}
