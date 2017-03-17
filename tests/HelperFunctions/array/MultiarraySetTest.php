<?php

namespace Illuminated\Helpers\HelperFunctions\Tests\ArrayTests;

use Illuminated\Helpers\HelperFunctions\Tests\TestCase;

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
    public function and_it_takes_multiarray_param_by_reference()
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
}
