<?php

namespace Illuminated\Helpers\Tests\artisan;

use Illuminated\Helpers\Tests\TestCase;
use PHPUnit\Framework\Attributes\PreserveGlobalState;
use PHPUnit\Framework\Attributes\RunInSeparateProcess;
use PHPUnit\Framework\Attributes\Test;

class CallInBackgroundTest extends TestCase
{
    #[Test] #[RunInSeparateProcess] #[PreserveGlobalState(false)]
    public function it_works_without_optional_before_and_after_parameters(): void
    {
        $mock = mock('alias:Illuminated\Helpers\Artisan\BackgroundCommand');
        $mock->expects('factory')->with('test command', '', '')->andReturnSelf();
        $mock->expects('run');

        call_in_background('test command');
    }

    #[Test] #[RunInSeparateProcess] #[PreserveGlobalState(false)]
    public function it_works_with_optional_before_parameter(): void
    {
        $mock = mock('alias:Illuminated\Helpers\Artisan\BackgroundCommand');
        $mock->expects('factory')->with('test command', 'before command', '')->andReturnSelf();
        $mock->expects('run');

        call_in_background('test command', 'before command');
    }

    #[Test] #[RunInSeparateProcess] #[PreserveGlobalState(false)]
    public function it_works_with_optional_after_parameter(): void
    {
        $mock = mock('alias:Illuminated\Helpers\Artisan\BackgroundCommand');
        $mock->expects('factory')->with('test command', '', 'after command')->andReturnSelf();
        $mock->expects('run');

        call_in_background('test command', '', 'after command');
    }

    #[Test] #[RunInSeparateProcess] #[PreserveGlobalState(false)]
    public function it_works_with_optional_before_and_after_parameters_together(): void
    {
        $mock = mock('alias:Illuminated\Helpers\Artisan\BackgroundCommand');
        $mock->expects('factory')->with('test command', 'before', 'after')->andReturnSelf();
        $mock->expects('run');

        call_in_background('test command', 'before', 'after');
    }
}
