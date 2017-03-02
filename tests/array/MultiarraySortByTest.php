<?php

class MultiarraySortByTest extends TestCase
{
    /** @test */
    public function it_can_sort_by_one_field_without_specifying_sort_order_which_is_asc_by_default()
    {
        $array = [
            ['name' => 'Mercedes-Benz', 'model' => 'GLE Coupe', 'price' => 110000],
            ['name' => 'BMW', 'model' => 'X6', 'price' => 77000],
            ['name' => 'Porsche', 'model' => 'Cayenne', 'price' => 117000],
        ];

        $expected = [
            ['name' => 'BMW', 'model' => 'X6', 'price' => 77000],
            ['name' => 'Mercedes-Benz', 'model' => 'GLE Coupe', 'price' => 110000],
            ['name' => 'Porsche', 'model' => 'Cayenne', 'price' => 117000],
        ];

        $this->assertEquals($expected, multiarray_sort_by($array, 'price'));
    }

    /** @test */
    public function it_can_sort_by_one_field_with_specifying_sort_order()
    {
        $array = [
            ['name' => 'Mercedes-Benz', 'model' => 'GLE Coupe', 'price' => 110000],
            ['name' => 'BMW', 'model' => 'X6', 'price' => 77000],
            ['name' => 'Porsche', 'model' => 'Cayenne', 'price' => 117000],
        ];

        $expected = [
            ['name' => 'Porsche', 'model' => 'Cayenne', 'price' => 117000],
            ['name' => 'Mercedes-Benz', 'model' => 'GLE Coupe', 'price' => 110000],
            ['name' => 'BMW', 'model' => 'X6', 'price' => 77000],
        ];

        $this->assertEquals($expected, multiarray_sort_by($array, 'price', SORT_DESC));
    }

    /** @test */
    public function it_can_sort_by_two_fields_without_specifying_sort_order()
    {
        $array = [
            ['name' => 'Mercedes-Benz', 'model' => 'GLS', 'price' => 120000],
            ['name' => 'Mercedes-Benz', 'model' => 'GLE Coupe', 'price' => 110000],
            ['name' => 'BMW', 'model' => 'X6', 'price' => 77000],
            ['name' => 'Porsche', 'model' => 'Cayenne', 'price' => 117000],
        ];

        $expected = [
            ['name' => 'BMW', 'model' => 'X6', 'price' => 77000],
            ['name' => 'Mercedes-Benz', 'model' => 'GLE Coupe', 'price' => 110000],
            ['name' => 'Mercedes-Benz', 'model' => 'GLS', 'price' => 120000],
            ['name' => 'Porsche', 'model' => 'Cayenne', 'price' => 117000],
        ];

        $this->assertEquals($expected, multiarray_sort_by($array, 'name', 'model'));
    }
}
