<?php

namespace Illuminated\Helpers\Tests\json;

use Illuminated\Helpers\Tests\TestCase;
use PHPUnit\Framework\Attributes\Test;
use StdClass;

class IsJsonTest extends TestCase
{
    #[Test]
    public function it_returns_false_for_null(): void
    {
        $this->assertFalse(is_json(null));
    }

    #[Test]
    public function it_returns_false_for_boolean_true(): void
    {
        $this->assertFalse(is_json(true));
    }

    #[Test]
    public function it_returns_false_for_boolean_false(): void
    {
        $this->assertFalse(is_json(false));
    }

    #[Test]
    public function it_returns_false_for_integer(): void
    {
        $this->assertFalse(is_json(123));
    }

    #[Test]
    public function it_returns_false_for_float(): void
    {
        $this->assertFalse(is_json(123.45));
    }

    #[Test]
    public function it_returns_false_for_an_empty_string(): void
    {
        $this->assertFalse(is_json(''));
    }

    #[Test]
    public function it_returns_false_for_non_json_string(): void
    {
        $this->assertFalse(is_json('non-json string'));
    }

    #[Test]
    public function it_returns_false_for_empty_array(): void
    {
        $this->assertFalse(is_json([]));
    }

    #[Test]
    public function it_returns_false_for_non_empty_array(): void
    {
        $this->assertFalse(is_json(['foo' => 'bar']));
    }

    #[Test]
    public function it_returns_false_for_object(): void
    {
        $this->assertFalse(is_json(new StdClass()));
    }

    #[Test]
    public function it_returns_false_for_non_json_and_second_argument_passed(): void
    {
        $this->assertFalse(is_json('non-json string', true));
    }

    #[Test]
    public function it_returns_true_for_json_encoded_null(): void
    {
        $json = json_encode(null);
        $this->assertTrue(is_json($json));
    }

    #[Test]
    public function it_returns_true_for_json_encoded_boolean_true(): void
    {
        $json = json_encode(true);
        $this->assertTrue(is_json($json));
    }

    #[Test]
    public function it_returns_true_for_json_encoded_boolean_false(): void
    {
        $json = json_encode(false);
        $this->assertTrue(is_json($json));
    }

    #[Test]
    public function it_returns_true_for_json_encoded_integer(): void
    {
        $json = json_encode(123);
        $this->assertTrue(is_json($json));
    }

    #[Test]
    public function it_returns_true_for_json_encoded_float(): void
    {
        $json = json_encode(123.45);
        $this->assertTrue(is_json($json));
    }

    #[Test]
    public function it_returns_true_for_json_encoded_string(): void
    {
        $json = json_encode('string to encode');
        $this->assertTrue(is_json($json));
    }

    #[Test]
    public function it_returns_true_for_json_encoded_array(): void
    {
        $json = json_encode(['foo' => 'bar']);
        $this->assertTrue(is_json($json));
    }

    #[Test]
    public function it_returns_true_for_json_encoded_object(): void
    {
        $json = json_encode((object) ['foo' => 'bar', 'baz' => 'bax']);
        $this->assertTrue(is_json($json));
    }

    #[Test]
    public function it_returns_decoded_json_with_second_argument_passed(): void
    {
        $array = ['foo' => 'bar', 'baz' => 'bax'];
        $json = json_encode($array);
        $this->assertEquals($array, is_json($json, true));
    }
}
