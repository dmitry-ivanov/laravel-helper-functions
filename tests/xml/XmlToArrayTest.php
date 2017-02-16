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
            ],
        ];

        $this->assertEquals($expected, xml_to_array($xml));
    }

    /** @test */
    public function it_throws_an_exception_if_non_xml_string_passed()
    {
        $this->willSeeException(Exception::class, 'String could not be parsed as XML');

        xml_to_array('Non XML');
    }
}
