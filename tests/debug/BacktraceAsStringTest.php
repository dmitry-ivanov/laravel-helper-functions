<?php

namespace Illuminated\Helpers\Tests\Debug;

use Illuminated\Helpers\Tests\TestCase;

class BacktraceAsStringTest extends TestCase
{
    /** @test */
    public function it_returns_backtrace_as_string_without_args()
    {
        $pattern = file_get_contents(__DIR__ . '/BacktraceAsStringTest/pattern.txt');
        $backtrace = $this->getBacktrace();

        $this->assertRegExp("/{$pattern}/m", $backtrace);
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
