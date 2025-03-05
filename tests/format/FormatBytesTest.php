<?php

namespace Illuminated\Helpers\Tests\format;

use Illuminated\Helpers\Tests\TestCase;
use PHPUnit\Framework\Attributes\Test;

class FormatBytesTest extends TestCase
{
    #[Test]
    public function it_returns_zero_for_negative_bytes(): void
    {
        $this->assertEquals('0 B', format_bytes(-100));
    }

    #[Test]
    public function it_works_with_bytes(): void
    {
        $this->assertEquals('450 B', format_bytes(450));
    }

    #[Test]
    public function it_works_with_kilobytes(): void
    {
        $this->assertEquals('3.68 KB', format_bytes(3768));
    }

    #[Test]
    public function it_works_with_megabytes(): void
    {
        $this->assertEquals('15.04 MB', format_bytes(15768749));
    }

    #[Test]
    public function it_works_with_gigabytes(): void
    {
        $this->assertEquals('6.91 GB', format_bytes(7415768749));
    }

    #[Test]
    public function it_works_with_terabytes(): void
    {
        $this->assertEquals('8.31 TB', format_bytes(9137415768749));
    }

    #[Test]
    public function terabytes_is_the_greatest_unit(): void
    {
        $this->assertEquals('6702.19 TB', format_bytes(7369137415768749));
    }

    #[Test]
    public function it_works_with_zero_precision(): void
    {
        $this->assertEquals('703 MB', format_bytes(736968749, 0));
    }

    #[Test]
    public function it_works_with_custom_precision(): void
    {
        $this->assertEquals('80.121 MB', format_bytes(84012659, 3));
    }
}
