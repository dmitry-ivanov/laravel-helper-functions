<?php

namespace Illuminated\Helpers\Tests\debug;

use Illuminated\Helpers\Tests\TestCase;

class BacktraceAsStringTest extends TestCase
{
    /** @test */
    public function it_returns_backtrace_as_string_without_args()
    {
        $pattern = file_get_contents(__DIR__ . '/BacktraceAsStringTest/pattern.txt');
        $backtrace = $this->getBacktrace();

        $this->assertMatchesRegularExpression("/{$pattern}/m", $backtrace);
    }

    /**
     * This method is used to simply add calls in the backtrace.
     */
    private function getBacktrace(): string
    {
        return $this->anotherExtraMethod();
    }

    /**
     * This method is used to simply add calls in the backtrace.
     */
    private function anotherExtraMethod(): string
    {
        return backtrace_as_string();
    }
}
