<?php

namespace Illuminated\Helpers\HelperFunctions\Tests\Debug;

use Illuminated\Helpers\HelperFunctions\Tests\TestCase;

class BacktraceAsStringTest extends TestCase
{
    /** @test */
    public function it_returns_backtrace_as_string_without_args()
    {
        $start = file_get_contents($this->getPath());
        $backtrace = $this->getBacktrace();

        $this->assertStringStartsWith($start, $backtrace);
    }

    private function getPath()
    {
        $travis = $this->isTravis() ? '.travis' : '';

        return __DIR__ . "/BacktraceAsStringTest/backtrace{$travis}.txt";
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
