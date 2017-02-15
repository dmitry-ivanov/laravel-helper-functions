<?php

class MinimizedBacktraceAsStringTest extends TestCase
{
    /** @test */
    public function it_returns_minimized_backtrace_as_string()
    {
        $travis = $this->isTravis() ? '.travis' : '';
        $path = __DIR__ . "/MinimizedBacktraceAsStringTest/backtrace{$travis}.txt";

        $start = file_get_contents($path);
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
