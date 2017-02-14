<?php

class MinimizedBacktraceAsStringTest extends TestCase
{
    /** @test */
    public function it_returns_minimized_backtrace_as_string()
    {
        $start = file_get_contents(__DIR__ . '/MinimizedBacktraceAsStringTest/backtrace.txt');
        $backtrace = $this->getBacktrace();
        $this->assertStringStartsWith($start, $backtrace);
    }

    private function getBacktrace()
    {
        return $this->anotherExtraMethod();
    }

    private function anotherExtraMethod()
    {
        return minimized_backtrace_as_string();
    }
}
