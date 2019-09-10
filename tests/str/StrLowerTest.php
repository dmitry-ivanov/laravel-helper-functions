<?php

namespace Illuminated\Helpers\Tests\Str;

use Illuminated\Helpers\Tests\TestCase;

class StrLowerTest extends TestCase
{
    /** @test */
    public function it_lowers_empty_string()
    {
        $this->assertEquals('', str_lower(''));
    }

    /** @test */
    public function it_lowers_lowercased_string()
    {
        $this->assertEquals('test', str_lower('test'));
    }

    /** @test */
    public function it_lowers_lowercased_sentence()
    {
        $this->assertEquals('another test', str_lower('another test'));
    }

    /** @test */
    public function it_lowers_capitalized_word()
    {
        $this->assertEquals('test', str_lower('Test'));
    }

    /** @test */
    public function it_lowers_mixed_word()
    {
        $this->assertEquals('test', str_lower('TeSt'));
    }

    /** @test */
    public function it_lowers_uppercased_word()
    {
        $this->assertEquals('test', str_lower('TEST'));
    }

    /** @test */
    public function it_lowers_capitalized_sentence()
    {
        $this->assertEquals('another test', str_lower('Another Test'));
    }

    /** @test */
    public function it_lowers_mixed_sentence()
    {
        $this->assertEquals('another test', str_lower('AnoTHer TeST'));
    }

    /** @test */
    public function it_lowers_uppercased_sentence()
    {
        $this->assertEquals('another test', str_lower('ANOTHER TEST'));
    }

    /** @test */
    public function it_lowers_mixed_sentence_with_special_chars()
    {
        $this->assertEquals('another-test!', str_lower('AnoTHer-TeST!'));
    }
}
