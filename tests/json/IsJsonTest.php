<?php

class IsJsonTest extends TestCase
{
    /** @test */
    public function it_returns_false_for_null()
    {
        $this->assertFalse(is_json(null));
    }

    /** @test */
    public function it_returns_false_for_boolean_true()
    {
        $this->assertFalse(is_json(true));
    }

    /** @test */
    public function it_returns_false_for_boolean_false()
    {
        $this->assertFalse(is_json(false));
    }

    /** @test */
    public function it_returns_false_for_integer()
    {
        $this->assertFalse(is_json(123));
    }

    /** @test */
    public function it_returns_false_for_float()
    {
        $this->assertFalse(is_json(123.45));
    }

    /** @test */
    public function it_returns_false_for_an_empty_string()
    {
        $this->assertFalse(is_json(''));
    }

    /** @test */
    public function it_returns_false_for_non_json_string()
    {
        $this->assertFalse(is_json('non-json string'));
    }

    /** @test */
    public function it_returns_false_for_empty_array()
    {
        $this->assertFalse(is_json([]));
    }

    /** @test */
    public function it_returns_false_for_non_empty_array()
    {
        $this->assertFalse(is_json(['foo' => 'bar']));
    }

    /** @test */
    public function it_returns_false_for_object()
    {
        $this->assertFalse(is_json(new StdClass()));
    }

    /** @test */
    public function it_returns_false_for_non_json_and_second_argument_passed()
    {
        $this->assertFalse(is_json('non-json string', true));
    }

    /** @test */
    public function it_returns_true_for_json_encoded_null()
    {
        $json = json_encode(null);
        $this->assertTrue(is_json($json));
    }

    /** @test */
    public function it_returns_true_for_json_encoded_boolean_true()
    {
        $json = json_encode(true);
        $this->assertTrue(is_json($json));
    }

    /** @test */
    public function it_returns_true_for_json_encoded_boolean_false()
    {
        $json = json_encode(false);
        $this->assertTrue(is_json($json));
    }

    /** @test */
    public function it_returns_true_for_json_encoded_integer()
    {
        $json = json_encode(123);
        $this->assertTrue(is_json($json));
    }

    /** @test */
    public function it_returns_true_for_json_encoded_float()
    {
        $json = json_encode(123.45);
        $this->assertTrue(is_json($json));
    }

    /** @test */
    public function it_returns_true_for_json_encoded_string()
    {
        $json = json_encode('string to encode');
        $this->assertTrue(is_json($json));
    }

    /** @test */
    public function it_returns_true_for_json_encoded_array()
    {
        $json = json_encode(['foo' => 'bar']);
        $this->assertTrue(is_json($json));
    }

    /** @test */
    public function it_returns_true_for_json_encoded_object()
    {
        $json = json_encode((object) ['foo' => 'bar', 'baz' => 'bax']);
        $this->assertTrue(is_json($json));
    }

    /** @test */
    public function it_returns_decoded_json_with_second_argument_passed()
    {
        $array = ['foo' => 'bar', 'baz' => 'bax'];
        $json = json_encode($array);
        $this->assertEquals($array, is_json($json, true));
    }
}
