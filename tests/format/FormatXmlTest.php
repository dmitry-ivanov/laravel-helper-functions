<?php

class FormatXmlTest extends TestCase
{
    /** @test */
    public function it_formats_passed_xml_string()
    {
        $unformatted = file_get_contents(__DIR__ . '/FormatXmlTest/unformatted.xml');
        $expected = file_get_contents(__DIR__ . '/FormatXmlTest/formatted.xml');

        $this->assertEquals($expected, format_xml($unformatted));
    }
}
