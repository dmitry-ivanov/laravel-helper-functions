<?php

class CallInBackgroundTest extends TestCase
{
    /** @test */
    public function it_returns_false_for_an_empty_command()
    {
        $this->assertFalse(call_in_background(null));
        $this->assertFalse(call_in_background(false));
        $this->assertFalse(call_in_background(''));
    }

    /** @test */
    public function it_returns_false_for_non_string_command()
    {
        $this->assertFalse(call_in_background(123));
        $this->assertFalse(call_in_background(123.45));
        $this->assertFalse(call_in_background(['array']));
        $this->assertFalse(call_in_background(new StdClass()));
    }

    /** @test */
    public function it_returns_false_for_non_string_before_parameter()
    {
        $this->assertFalse(call_in_background('command', 123));
        $this->assertFalse(call_in_background('command', 123.45));
        $this->assertFalse(call_in_background('command', ['array']));
        $this->assertFalse(call_in_background('command', new StdClass()));
    }

    /** @test */
    public function it_returns_false_for_non_string_after_parameter()
    {
        $this->assertFalse(call_in_background('command', null, 123));
        $this->assertFalse(call_in_background('command', null, 123.45));
        $this->assertFalse(call_in_background('command', null, ['array']));
        $this->assertFalse(call_in_background('command', null, new StdClass()));
    }

    /** @test */
    public function it_works_without_before_and_after_parameters()
    {
        //
    }

    /** @test */
    public function it_works_with_only_before_parameter()
    {
        //
    }

    /** @test */
    public function it_works_with_only_after_parameter()
    {
        //
    }

    /** @test */
    public function it_works_with_before_and_after_parameters()
    {
        //
    }
}
