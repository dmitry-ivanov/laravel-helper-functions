<?php

namespace Illuminated\Helpers\HelperFunctions\Tests\Artisan;

use Illuminated\Helpers\HelperFunctions\Tests\TestCase;

/**
 * @runTestsInSeparateProcesses
 * @preserveGlobalState disabled
 */
class CallInBackgroundTest extends TestCase
{
    /** @test */
    public function it_works_without_optional_before_and_after_parameters()
    {
        $mock = mock('alias:Illuminated\Helpers\Artisan\Command');
        $mock->expects()->factory('test command', null, null)->andReturnSelf();
        $mock->expects()->runInBackground();

        call_in_background('test command');
    }

    /** @test */
    public function it_works_with_optional_before_parameter()
    {
        $mock = mock('alias:Illuminated\Helpers\Artisan\Command');
        $mock->expects()->factory('test command', 'before command', null)->andReturnSelf();
        $mock->expects()->runInBackground();

        call_in_background('test command', 'before command');
    }

    /** @test */
    public function it_works_with_optional_after_parameter()
    {
        $mock = mock('alias:Illuminated\Helpers\Artisan\Command');
        $mock->expects()->factory('test command', null, 'after command')->andReturnSelf();
        $mock->expects()->runInBackground();

        call_in_background('test command', null, 'after command');
    }

    /** @test */
    public function it_works_with_optional_before_and_after_parameters_together()
    {
        $mock = mock('alias:Illuminated\Helpers\Artisan\Command');
        $mock->expects()->factory('test command', 'before', 'after')->andReturnSelf();
        $mock->expects()->runInBackground();

        call_in_background('test command', 'before', 'after');
    }
}
