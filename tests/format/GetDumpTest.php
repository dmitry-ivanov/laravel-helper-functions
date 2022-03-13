<?php

namespace Illuminated\Helpers\Tests\format;

use Illuminate\Support\Arr;
use Illuminated\Helpers\Tests\TestCase;

class GetDumpTest extends TestCase
{
    /** @test */
    public function it_correctly_dumps_null()
    {
        $this->assertEquals("null\n", get_dump(null));
    }

    /** @test */
    public function it_correctly_dumps_boolean_true()
    {
        $this->assertEquals("true\n", get_dump(true));
    }

    /** @test */
    public function it_correctly_dumps_boolean_false()
    {
        $this->assertEquals("false\n", get_dump(false));
    }

    /** @test */
    public function it_correctly_dumps_integer()
    {
        $this->assertEquals("123\n", get_dump(123));
    }

    /** @test */
    public function it_correctly_dumps_float()
    {
        $this->assertEquals("123.45\n", get_dump(123.45));
    }

    /** @test */
    public function it_correctly_dumps_string()
    {
        $this->assertEquals("\"some string to dump\"\n", get_dump('some string to dump'));
    }

    /** @test */
    public function it_correctly_dumps_array()
    {
        $array = [
            'a simple string' => 'in an array of 5 elements',
            'a float' => 1.0,
            'an integer' => 1,
            'a boolean' => true,
            'an empty array' => [],
        ];

        $expected = "array:5 [\n"
            . "    \"a simple string\" => \"in an array of 5 elements\"\n"
            . "    \"a float\" => 1.0\n"
            . "    \"an integer\" => 1\n"
            . "    \"a boolean\" => true\n"
            . "    \"an empty array\" => []\n"
            . "]\n";

        $this->assertEquals($expected, get_dump($array));
    }

    /** @test */
    public function it_correctly_dumps_array_with_very_long_strings()
    {
        $dump = get_dump([str_repeat('x', 3000)]);
        $this->assertStringNotContainsString('…', $dump);
        $this->assertStringNotContainsString('...', $dump);
    }

    /** @test */
    public function it_correctly_dumps_array_with_huge_amount_of_items()
    {
        $array = range(1, 3);
        $subArray = range(1, 3000);
        $array = array_map(function () use ($subArray) {
            return $subArray;
        }, $array);

        $dump = get_dump($array);
        $this->assertStringNotContainsString('…', $dump);
        $this->assertStringNotContainsString('...', $dump);
    }

    /** @test */
    public function it_correctly_dumps_array_with_depth_50()
    {
        $key = trim(str_repeat('foo.', 50), '.');
        $array = Arr::add([], $key, 'bar');

        $dump = get_dump($array);
        $this->assertStringNotContainsString('…', $dump);
        $this->assertStringNotContainsString('...', $dump);
    }
}
