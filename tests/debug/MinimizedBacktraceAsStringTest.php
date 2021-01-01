<?php

namespace Illuminated\Helpers\Tests\Debug;

use Illuminated\Helpers\Tests\TestCase;

class MinimizedBacktraceAsStringTest extends TestCase
{
    /** @test */
    public function it_returns_minimized_backtrace_as_string()
    {
        $pattern = file_get_contents(__DIR__ . '/MinimizedBacktraceAsStringTest/pattern.txt');
        $backtrace = $this->getBacktrace();

        $this->assertMatchesRegularExpression("/{$pattern}/m", $backtrace);
    }

    /**
     * This method is used to simply add calls in the backtrace.
     *
     * @return string
     */
    private function getBacktrace()
    {
        return $this->anotherExtraMethod();
    }

    /**
     * This method is used to simply add calls in the backtrace.
     *
     * @return string
     */
    private function anotherExtraMethod()
    {
        return minimized_backtrace_as_string();
    }
}
