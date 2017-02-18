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
    public function it_supports_xml_attributes_in_converting()
    {
        $array = [
            'task' => [
                0 => [
                    'to' => 'John',
                    'from' => 'Jane',
                    'title' => 'Go to the shop',
                    '@attributes' => [
                        'priority' => 'low',
                    ],
                ],
                1 => [
                    'to' => 'John',
                    'from' => 'Paul',
                    'title' => 'Finish the report',
                    '@attributes' => [
                        'priority' => 'medium',
                    ],
                ],
                2 => [
                    'to' => 'Jane',
                    'from' => 'Jeff',
                    'title' => 'Clean the house',
                    '@attributes' => [
                        'priority' => 'high',
                    ],
                ],
            ],
        ];

        $expected = file_get_contents(__DIR__ . '/ArrayToXmlTest/with-attributes.xml');

        $this->assertEquals($expected, array_to_xml($array));
    }

    /** @test */
    public function it_supports_custom_root_element_name()
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

    /** @test */
    public function it_replaces_spaces_by_under_scores_in_key_names_by_default()
    {
        $array = [
            'task' => [
                0 => [
                    'to who' => 'John',
                    'from who' => 'Jane',
                    'title' => 'Go to the shop',
                ],
                1 => [
                    'to who' => 'John',
                    'from who' => 'Paul',
                    'title' => 'Finish the report',
                ],
                2 => [
                    'to who' => 'Jane',
                    'from who' => 'Jeff',
                    'title' => 'Clean the house',
                ],
            ],
        ];

        $expected = file_get_contents(__DIR__ . '/ArrayToXmlTest/with-spaces-in-keys.xml');

        $this->assertEquals($expected, array_to_xml($array));
    }
}
