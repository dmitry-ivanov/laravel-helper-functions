<?php

namespace Illuminated\Helpers\Tests\format;

use Exception;
use Illuminated\Helpers\Tests\TestCase;
use PHPUnit\Framework\Attributes\Test;

class FormatXmlTest extends TestCase
{
    #[Test]
    public function it_formats_passed_xml_string(): void
    {
        $unformatted = file_get_contents(__DIR__ . '/FormatXmlTest/unformatted.xml');
        $formatted = file_get_contents(__DIR__ . '/FormatXmlTest/formatted.xml');

        $this->assertEquals($formatted, format_xml($unformatted));
    }

    #[Test]
    public function it_throws_an_exception_if_non_xml_string_passed(): void
    {
        $this->expectException(Exception::class);
        $this->expectExceptionMessage('String could not be parsed as XML');

        @format_xml('Non XML');
    }
}
