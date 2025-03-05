<?php

namespace Illuminated\Helpers\Tests\xml;

use Exception;
use Illuminated\Helpers\Tests\TestCase;
use PHPUnit\Framework\Attributes\Test;
use SimpleXMLElement;

class XmlToArrayTest extends TestCase
{
    #[Test]
    public function it_transforms_xml_string_to_array(): void
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

    #[Test]
    public function it_also_allows_to_pass_simplexmlelement_object(): void
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

    #[Test]
    public function it_throws_an_exception_if_non_xml_string_passed(): void
    {
        $this->expectException(Exception::class);
        $this->expectExceptionMessage('String could not be parsed as XML');

        @xml_to_array('Non XML');
    }

    #[Test]
    public function it_is_fully_compatible_with_array_to_xml_helper(): void
    {
        $xml = file_get_contents(__DIR__ . '/XmlToArrayTest/example.xml');

        $this->assertEquals($xml, array_to_xml(xml_to_array($xml)));
    }
}
