<?php

namespace Illuminated\Helpers\Tests\Debug;

use Illuminated\Helpers\Tests\TestCase;

class BacktraceAsStringTest extends TestCase
{
    /** @test */
    public function it_returns_backtrace_as_string_without_args()
    {
        $start = file_get_contents($this->getExpectedBacktracePath());
        $backtrace = $this->getBacktrace();

        $this->assertStringStartsWith($start, $backtrace);
    }

    /**
     * Get the expected backtrace path.
     *
     * @return string
     */
    private function getExpectedBacktracePath()
    {
        $travis = $this->isTravis() ? '.travis' : '';

        return __DIR__ . "/BacktraceAsStringTest/backtrace{$travis}.txt";
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
        return backtrace_as_string();
    }
}
