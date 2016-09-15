<?php

class IsJsonTest extends TestCase
{
    /** @test */
    public function it_returns_false_with_null_passed()
    {
        $this->assertFalse(is_json(null));
    }

    /** @test */
    public function it_returns_false_with_boolean_true_passed()
    {
        $this->assertFalse(is_json(true));
    }

    /** @test */
    public function it_returns_false_with_boolean_false_passed()
    {
        $this->assertFalse(is_json(false));
    }

    /** @test */
    public function it_returns_false_with_integer_passed()
    {
        $this->assertFalse(is_json(123));
    }

    /** @test */
    public function it_returns_false_with_float_passed()
    {
        $this->assertFalse(is_json(123.45));
    }

    /** @test */
    public function it_returns_false_with_empty_array_passed()
    {
        $this->assertFalse(is_json([]));
    }

    /** @test */
    public function it_returns_false_with_non_empty_array_passed()
    {
        $this->assertFalse(is_json(['foo' => 'bar']));
    }

    /** @test */
    public function it_returns_false_with_an_empty_string_passed()
    {
        $this->assertFalse(is_json(''));
    }

    /** @test */
    public function it_returns_false_with_non_json_string_passed()
    {
        $this->assertFalse(is_json('non-json string'));
    }

    /** @test */
    public function it_returns_true_with_json_string_passed()
    {
        $json = json_encode(['foo' => 'bar']);
        $this->assertTrue(is_json($json));
    }
}
