<?php

namespace Illuminated\Helpers\Tests\array;

use Illuminated\Helpers\Tests\TestCase;
use PHPUnit\Framework\Attributes\Test;

class ArrayExceptValueTest extends TestCase
{
    #[Test]
    public function it_returns_array_itself_after_excluding_not_existing_value(): void
    {
        $this->assertEquals([], array_except_value([], null));
        $this->assertEquals([], array_except_value([], 'foo'));
        $this->assertEquals(['foo', 'bar', 'baz'], array_except_value(['foo', 'bar', 'baz'], 'bax'));
    }

    #[Test]
    public function it_preserves_keys_after_excluding_value(): void
    {
        $this->assertEquals(
            [0 => 'foo', 2 => 'baz'],
            array_except_value(['foo', 'bar', 'baz'], 'bar')
        );
    }

    #[Test]
    public function it_excludes_all_occurrences_of_the_value(): void
    {
        $this->assertEquals(
            [0 => 'foo', 4 => 'bar'],
            array_except_value(['foo', 'baz', 'baz', 'baz', 'bar'], 'baz')
        );
    }

    #[Test]
    public function it_can_exclude_null_value(): void
    {
        $this->assertEquals(['foo', 'bar', 'baz'], array_except_value(['foo', 'bar', 'baz', null], null));
    }

    #[Test]
    public function it_can_exclude_boolean_true_value(): void
    {
        $this->assertEquals(['foo', 'bar', 'baz'], array_except_value(['foo', 'bar', 'baz', true, true], true));
    }

    #[Test]
    public function it_can_exclude_boolean_false_value(): void
    {
        $this->assertEquals(
            ['foo', 'bar', 'baz', 5 => null],
            array_except_value(['foo', 'bar', 'baz', false, false, null], false)
        );
    }

    #[Test]
    public function it_can_exclude_integer_value(): void
    {
        $this->assertEquals(
            [0 => 23, 2 => 14, 3 => 11],
            array_except_value([23, 17, 14, 11], 17)
        );
    }

    #[Test]
    public function it_can_exclude_float_value(): void
    {
        $this->assertEquals(
            [0 => 23.3, 1 => 17.2, 3 => 11.1],
            array_except_value([23.3, 17.2, 14.5, 11.1], 14.5)
        );
    }

    #[Test]
    public function it_can_exclude_string_value(): void
    {
        $this->assertEquals(['foo', 'bar'], array_except_value(['foo', 'bar', 'baz'], 'baz'));
    }

    #[Test]
    public function it_can_exclude_multiple_different_values(): void
    {
        $array = ['foo', 'bar', 'baz', 'bax'];
        $this->assertEquals([1 => 'bar', 2 => 'baz'], array_except_value($array, ['foo', 'bax']));
    }

    #[Test]
    public function it_works_with_associative_array_and_single_value(): void
    {
        $array = [
            'foo' => 'bar',
            'baz' => 'bax',
            'foz' => 'faz',
        ];
        $this->assertEquals(['foo' => 'bar', 'foz' => 'faz'], array_except_value($array, 'bax'));
    }

    #[Test]
    public function it_works_with_associative_array_and_multiple_values(): void
    {
        $array = [
            'foo' => 'bar',
            'baz' => 'bax',
            'foz' => 'faz',
        ];
        $this->assertEquals(['baz' => 'bax'], array_except_value($array, ['bar', 'faz', 'maz']));
    }
}
