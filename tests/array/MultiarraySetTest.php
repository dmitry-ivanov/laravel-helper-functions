<?php

namespace Illuminated\Helpers\Tests\array;

use Illuminated\Helpers\Tests\TestCase;
use PHPUnit\Framework\Attributes\Test;

class MultiarraySetTest extends TestCase
{
    #[Test]
    public function it_can_set_new_field_for_each_item_of_multiarray(): void
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

    #[Test]
    public function it_takes_multiarray_param_by_reference(): void
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

    #[Test]
    public function it_can_set_existing_field_for_each_item_of_multiarray(): void
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

    #[Test]
    public function it_can_set_new_field_for_each_item_of_multiarray_using_dot_notation(): void
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

    #[Test]
    public function it_can_set_existing_field_for_each_item_of_multiarray_using_dot_notation(): void
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
