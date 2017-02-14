<?php

class BacktraceAsStringTest extends TestCase
{
    /** @test */
    public function it_returns_backtrace_as_string_without_args()
    {
        $travis = getenv('TRAVIS') ? '.travis' : '';
        $path = __DIR__ . "/BacktraceAsStringTest/backtrace{$travis}.txt";

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
        return backtrace_as_string();
    }
}
