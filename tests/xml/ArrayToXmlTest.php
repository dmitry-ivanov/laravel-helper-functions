<?php

class ArrayToXmlTest extends TestCase
{
    /** @test */
    public function it_converts_array_to_xml()
    {
        $array = [
            'task' => [
                0 => [
                    'to' => 'John',
                    'from' => 'Jane',
                    'title' => 'Go to the shop',
                ],
                1 => [
                    'to' => 'John',
                    'from' => 'Paul',
                    'title' => 'Finish the report',
                ],
                2 => [
                    'to' => 'Jane',
                    'from' => 'Jeff',
                    'title' => 'Clean the house',
                ],
            ],
        ];

        $expected = file_get_contents(__DIR__ . '/ArrayToXmlTest/without-attributes.xml');

        $this->assertEquals($expected, array_to_xml($array));
    }

    /** @test */
    public function is_supports_xml_attributes_in_converting()
    {
        $array = [
            'task' => [
                0 => [
                    'to' => 'John',
                    'from' => 'Jane',
                    'title' => 'Go to the shop',
                    '_attributes' => [
                        'priority' => 'low',
                    ],
                ],
                1 => [
                    'to' => 'John',
                    'from' => 'Paul',
                    'title' => 'Finish the report',
                    '_attributes' => [
                        'priority' => 'medium',
                    ],
                ],
                2 => [
                    'to' => 'Jane',
                    'from' => 'Jeff',
                    'title' => 'Clean the house',
                    '_attributes' => [
                        'priority' => 'high',
                    ],
                ],
            ],
        ];

        $expected = file_get_contents(__DIR__ . '/ArrayToXmlTest/with-attributes.xml');

        $this->assertEquals($expected, array_to_xml($array));
    }

    /** @test */
    public function is_supports_custom_root_element_name()
    {
        $array = [
            'task' => [
                0 => [
                    'to' => 'John',
                    'from' => 'Jane',
                    'title' => 'Go to the shop',
                ],
                1 => [
                    'to' => 'John',
                    'from' => 'Paul',
                    'title' => 'Finish the report',
                ],
                2 => [
                    'to' => 'Jane',
                    'from' => 'Jeff',
                    'title' => 'Clean the house',
                ],
            ],
        ];

        $expected = file_get_contents(__DIR__ . '/ArrayToXmlTest/with-custom-root.xml');

        $this->assertEquals($expected, array_to_xml($array, 'tasks'));
    }
}
