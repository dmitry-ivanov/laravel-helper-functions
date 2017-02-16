<?php

class XmlToArrayTest extends TestCase
{
    /** @test */
    public function it_transforms_xml_string_to_array()
    {
        $xml = file_get_contents(__DIR__ . '/XmlToArrayTest/example.xml');

        $expected = [
            'tasks' => [
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
            ],
        ];

        $this->assertEquals($expected, xml_to_array($xml));
    }

    /** @test */
    public function it_also_allows_to_pass_simplexmlelement_object()
    {
        $xml = new SimpleXMLElement(file_get_contents(__DIR__ . '/XmlToArrayTest/example.xml'));

        $expected = [
            'tasks' => [
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
            ],
        ];

        $this->assertEquals($expected, xml_to_array($xml));
    }
}
