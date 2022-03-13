<?php

namespace Illuminated\Helpers\Tests\artisan;

use Illuminated\Helpers\Tests\TestCase;

/**
 * @runTestsInSeparateProcesses
 * @preserveGlobalState disabled
 */
class CallInBackgroundTest extends TestCase
{
    /** @test */
    public function it_works_without_optional_before_and_after_parameters()
    {
        $mock = mock('alias:Illuminated\Helpers\Artisan\BackgroundCommand');
        $mock->expects('factory')->with('test command', '', '')->andReturnSelf();
        $mock->expects('run');

        call_in_background('test command');
    }

    /** @test */
    public function it_works_with_optional_before_parameter()
    {
        $mock = mock('alias:Illuminated\Helpers\Artisan\BackgroundCommand');
        $mock->expects('factory')->with('test command', 'before command', '')->andReturnSelf();
        $mock->expects('run');

        call_in_background('test command', 'before command');
    }

    /** @test */
    public function it_works_with_optional_after_parameter()
    {
        $mock = mock('alias:Illuminated\Helpers\Artisan\BackgroundCommand');
        $mock->expects('factory')->with('test command', '', 'after command')->andReturnSelf();
        $mock->expects('run');

        call_in_background('test command', '', 'after command');
    }

    /** @test */
    public function it_works_with_optional_before_and_after_parameters_together()
    {
        $mock = mock('alias:Illuminated\Helpers\Artisan\BackgroundCommand');
        $mock->expects('factory')->with('test command', 'before', 'after')->andReturnSelf();
        $mock->expects('run');

        call_in_background('test command', 'before', 'after');
    }
}
