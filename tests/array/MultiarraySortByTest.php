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
    public function it_can_sort_by_one_field_with_specifying_asc_sort_order()
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

        $this->assertEquals($expected, multiarray_sort_by($array, 'price', SORT_ASC));
    }

    /** @test */
    public function it_can_sort_by_one_field_with_specifying_desc_sort_order()
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
    public function it_can_sort_by_two_fields_without_specifying_sort_order_and_asc_would_be_used_for_both()
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

    /** @test */
    public function it_can_sort_by_two_fields_with_specifying_asc_sort_order_only_for_the_first()
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

        $this->assertEquals($expected, multiarray_sort_by($array, 'name', SORT_ASC, 'model'));
    }

    /** @test */
    public function it_can_sort_by_two_fields_with_specifying_asc_sort_order_only_for_the_second()
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

        $this->assertEquals($expected, multiarray_sort_by($array, 'name', 'model', SORT_ASC));
    }

    /** @test */
    public function it_can_sort_by_two_fields_with_specifying_asc_sort_order_for_both()
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

        $this->assertEquals($expected, multiarray_sort_by($array, 'name', SORT_ASC, 'model', SORT_ASC));
    }

    /** @test */
    public function it_can_sort_by_two_fields_with_specifying_desc_sort_orders()
    {
        $array = [
            ['name' => 'Mercedes-Benz', 'model' => 'GLS', 'price' => 120000],
            ['name' => 'Mercedes-Benz', 'model' => 'GLE Coupe', 'price' => 110000],
            ['name' => 'BMW', 'model' => 'X6', 'price' => 77000],
            ['name' => 'Porsche', 'model' => 'Cayenne', 'price' => 117000],
        ];

        $expected = [
            ['name' => 'Porsche', 'model' => 'Cayenne', 'price' => 117000],
            ['name' => 'Mercedes-Benz', 'model' => 'GLS', 'price' => 120000],
            ['name' => 'Mercedes-Benz', 'model' => 'GLE Coupe', 'price' => 110000],
            ['name' => 'BMW', 'model' => 'X6', 'price' => 77000],
        ];

        $this->assertEquals($expected, multiarray_sort_by($array, 'name', SORT_DESC, 'model', SORT_DESC));
    }
}
