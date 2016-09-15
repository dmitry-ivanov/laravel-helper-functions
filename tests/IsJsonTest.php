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
    public function it_returns_false_with_object_passed()
    {
        $this->assertFalse(is_json(new StdClass()));
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
    public function it_returns_false_with_non_json_string_and_second_argument_passed()
    {
        $this->assertFalse(is_json('non-json string', true));
    }

    /** @test */
    public function it_returns_true_with_json_encoded_null_passed()
    {
        $json = json_encode(null);
        $this->assertTrue(is_json($json));
    }

    /** @test */
    public function it_returns_true_with_json_encoded_boolean_true_passed()
    {
        $json = json_encode(true);
        $this->assertTrue(is_json($json));
    }

    /** @test */
    public function it_returns_true_with_json_encoded_boolean_false_passed()
    {
        $json = json_encode(false);
        $this->assertTrue(is_json($json));
    }

    /** @test */
    public function it_returns_true_with_json_encoded_integer_passed()
    {
        $json = json_encode(123);
        $this->assertTrue(is_json($json));
    }

    /** @test */
    public function it_returns_true_with_json_encoded_float_passed()
    {
        $json = json_encode(123.45);
        $this->assertTrue(is_json($json));
    }

    /** @test */
    public function it_returns_true_with_json_encoded_array_passed()
    {
        $json = json_encode(['foo' => 'bar']);
        $this->assertTrue(is_json($json));
    }

    /** @test */
    public function it_returns_true_with_json_encoded_object_passed()
    {
        $object = new StdClass();
        $object->foo = 'bar';
        $object->baz = 'bax';
        $json = json_encode($object);
        $this->assertTrue(is_json($json));
    }

    /** @test */
    public function it_returns_true_with_json_encoded_string_passed()
    {
        $json = json_encode('string to encode');
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
