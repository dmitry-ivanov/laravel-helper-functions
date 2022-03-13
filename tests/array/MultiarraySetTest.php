<?php

namespace Illuminated\Helpers\Tests\array;

use Illuminated\Helpers\Tests\TestCase;

class MultiarraySetTest extends TestCase
{
    /** @test */
    public function it_can_set_new_field_for_each_item_of_multiarray()
    {
        $multiarray = [
            ['name' => 'Mercedes-Benz'],
            ['name' => 'BMW'],
            ['name' => 'Porsche'],
        ];

        $expected = [
            ['name' => 'Mercedes-Benz', 'country' => 'Germany'],
            ['name' => 'BMW', 'country' => 'Germany'],
            ['name' => 'Porsche', 'country' => 'Germany'],
        ];

        $this->assertEquals($expected, multiarray_set($multiarray, 'country', 'Germany'));
    }

    /** @test */
    public function it_takes_multiarray_param_by_reference()
    {
        $multiarray = [
            ['name' => 'Mercedes-Benz'],
            ['name' => 'BMW'],
            ['name' => 'Porsche'],
        ];

        $expected = [
            ['name' => 'Mercedes-Benz', 'country' => 'Germany'],
            ['name' => 'BMW', 'country' => 'Germany'],
            ['name' => 'Porsche', 'country' => 'Germany'],
        ];

        multiarray_set($multiarray, 'country', 'Germany');

        $this->assertEquals($expected, $multiarray);
    }

    /** @test */
    public function it_can_set_existing_field_for_each_item_of_multiarray()
    {
        $multiarray = [
            ['name' => 'Mercedes-Benz', 'country' => 'Unknown'],
            ['name' => 'BMW', 'country' => 'Unknown'],
            ['name' => 'Porsche', 'country' => 'Unknown'],
        ];

        $expected = [
            ['name' => 'Mercedes-Benz', 'country' => 'Germany'],
            ['name' => 'BMW', 'country' => 'Germany'],
            ['name' => 'Porsche', 'country' => 'Germany'],
        ];

        $this->assertEquals($expected, multiarray_set($multiarray, 'country', 'Germany'));
    }

    /** @test */
    public function it_can_set_new_field_for_each_item_of_multiarray_using_dot_notation()
    {
        $multiarray = [
            ['name' => 'Mercedes-Benz', 'details' => ['type' => 'SUV']],
            ['name' => 'BMW', 'details' => ['type' => 'SUV']],
            ['name' => 'Porsche', 'details' => ['type' => 'SUV']],
        ];

        $expected = [
            ['name' => 'Mercedes-Benz', 'details' => ['type' => 'SUV', 'country' => 'Germany']],
            ['name' => 'BMW', 'details' => ['type' => 'SUV', 'country' => 'Germany']],
            ['name' => 'Porsche', 'details' => ['type' => 'SUV', 'country' => 'Germany']],
        ];

        $this->assertEquals($expected, multiarray_set($multiarray, 'details.country', 'Germany'));
    }

    /** @test */
    public function it_can_set_existing_field_for_each_item_of_multiarray_using_dot_notation()
    {
        $multiarray = [
            ['name' => 'Mercedes-Benz', 'details' => ['type' => 'SUV', 'country' => 'Unknown']],
            ['name' => 'BMW', 'details' => ['type' => 'SUV', 'country' => 'Unknown']],
            ['name' => 'Porsche', 'details' => ['type' => 'SUV', 'country' => 'Unknown']],
        ];

        $expected = [
            ['name' => 'Mercedes-Benz', 'details' => ['type' => 'SUV', 'country' => 'Germany']],
            ['name' => 'BMW', 'details' => ['type' => 'SUV', 'country' => 'Germany']],
            ['name' => 'Porsche', 'details' => ['type' => 'SUV', 'country' => 'Germany']],
        ];

        $this->assertEquals($expected, multiarray_set($multiarray, 'details.country', 'Germany'));
    }
}
