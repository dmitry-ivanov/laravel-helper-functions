<?php

namespace Illuminated\Helpers\HelperFunctions\Tests\Format;

use Illuminated\Helpers\HelperFunctions\Tests\TestCase;

class FormatBytesTest extends TestCase
{
    /** @test */
    public function it_returns_zero_for_negative_bytes()
    {
        $this->assertEquals('0 B', format_bytes(-100));
    }

    /** @test */
    public function it_works_with_bytes()
    {
        $this->assertEquals('450 B', format_bytes(450));
    }

    /** @test */
    public function it_works_with_kilobytes()
    {
        $this->assertEquals('3.68 KB', format_bytes(3768));
    }

    /** @test */
    public function it_works_with_megabytes()
    {
        $this->assertEquals('15.04 MB', format_bytes(15768749));
    }

    /** @test */
    public function it_works_with_gigabytes()
    {
        $this->assertEquals('6.91 GB', format_bytes(7415768749));
    }

    /** @test */
    public function it_works_with_terabytes()
    {
        $this->assertEquals('8.31 TB', format_bytes(9137415768749));
    }

    /** @test */
    public function terabytes_is_the_greatest_unit()
    {
        $this->assertEquals('6702.19 TB', format_bytes(7369137415768749));
    }

    /** @test */
    public function it_works_with_zero_precision()
    {
        $this->assertEquals('703 MB', format_bytes(736968749, 0));
    }

    /** @test */
    public function it_works_with_custom_precision()
    {
        $this->assertEquals('80.121 MB', format_bytes(84012659, 3));
    }
}
