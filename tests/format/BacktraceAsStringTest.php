<?php

class BacktraceAsStringTest extends TestCase
{
    /** @test */
    public function it_returns_backtrace_as_string_without_args()
    {
        $start = file_get_contents(__DIR__ . '/BacktraceAsStringTest/backtrace.txt');
        $backtrace = $this->getBacktrace();
        $this->assertStringStartsWith($start, $backtrace);
    }

    private function getBacktrace()
    {
        return $this->anotherExtraMethod();
    }

    private function anotherExtraMethod()
    {
        return backtrace_as_string();
    }
}
