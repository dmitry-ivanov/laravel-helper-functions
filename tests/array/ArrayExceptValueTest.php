<?php

class ArrayExceptValueTest extends TestCase
{
    /** @test */
    public function it_returns_empty_array_after_excluding_empty_value_from_empty_array()
    {
        $this->assertEquals([], array_except_value([], null));
    }

    /** @test */
    public function it_returns_empty_array_after_excluding_not_empty_value_from_empty_array()
    {
        $this->assertEquals([], array_except_value([], 'foo'));
    }

    /** @test */
    public function it_returns_array_itself_after_excluding_unexisting_value()
    {
        $this->assertEquals(['foo', 'bar', 'baz'], array_except_value(['foo', 'bar', 'baz'], 'bax'));
    }

    /** @test */
    public function it_preserves_keys_after_excluding_value()
    {
        $this->assertEquals(
            [0 => 'foo', 2 => 'baz'],
            array_except_value(['foo', 'bar', 'baz'], 'bar')
        );
    }

    /** @test */
    public function it_excludes_all_multiple_occurrences()
    {
        $this->assertEquals(
            [0 => 'foo', 4 => 'bar'],
            array_except_value(['foo', 'baz', 'baz', 'baz', 'bar'], 'baz')
        );
    }

    /** @test */
    public function it_works_with_null_value()
    {
        $this->assertEquals(['foo', 'bar', 'baz'], array_except_value(['foo', 'bar', 'baz', null], null));
    }

    /** @test */
    public function it_works_with_boolean_true_value()
    {
        $this->assertEquals(['foo', 'bar', 'baz'], array_except_value(['foo', 'bar', 'baz', true, true], true));
    }

    /** @test */
    public function it_works_with_boolean_false_value()
    {
        $this->assertEquals(
            ['foo', 'bar', 'baz', 5 => null],
            array_except_value(['foo', 'bar', 'baz', false, false, null], false)
        );
    }

    /** @test */
    public function it_works_with_integer_values()
    {
        $this->assertEquals(
            [0 => 23, 2 => 14, 3 => 11],
            array_except_value([23, 17, 14, 11], 17)
        );
    }

    /** @test */
    public function it_works_with_float_values()
    {
        $this->assertEquals(
            [0 => 23.3, 1 => 17.2, 3 => 11.1],
            array_except_value([23.3, 17.2, 14.5, 11.1], 14.5)
        );
    }

    /** @test */
    public function it_works_with_string_values()
    {
        $this->assertEquals(['foo', 'bar'], array_except_value(['foo', 'bar', 'baz'], 'baz'));
    }

    /** @test */
    public function it_works_with_associative_array_and_single_value()
    {
        $array = [
            'foo' => 'bar',
            'baz' => 'bax',
            'foz' => 'faz',
        ];
        $this->assertEquals(['foo' => 'bar', 'foz' => 'faz'], array_except_value($array, 'bax'));
    }

    /** @test */
    public function it_works_with_associative_array_and_multiple_values()
    {
        $array = [
            'foo' => 'bar',
            'baz' => 'bax',
            'foz' => 'faz',
        ];
        $this->assertEquals(['baz' => 'bax'], array_except_value($array, ['bar', 'faz', 'maz']));
    }
}
