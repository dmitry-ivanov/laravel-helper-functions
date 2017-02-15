<?php

class MinimizedBacktraceAsStringTest extends TestCase
{
    /** @test */
    public function it_returns_minimized_backtrace_as_string()
    {
        $start = file_get_contents($this->getPath());
        $backtrace = $this->getBacktrace();

        $this->assertStringStartsWith($start, $backtrace);
    }

    private function getPath()
    {
        $travis = $this->isTravis() ? '.travis' : '';

        return __DIR__ . "/MinimizedBacktraceAsStringTest/backtrace{$travis}.txt";
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
