<?php

class StrUpperTest extends TestCase
{
    /** @test */
    public function it_works_with_an_empty_string()
    {
        $this->assertEquals('', str_upper(''));
    }

    /** @test */
    public function it_uppers_capitalized_word()
    {
        $this->assertEquals('TEST', str_upper('Test'));
    }

    /** @test */
    public function it_uppers_mixed_word()
    {
        $this->assertEquals('TEST', str_upper('TeSt'));
    }

    /** @test */
    public function it_uppers_lowercased_word()
    {
        $this->assertEquals('TEST', str_upper('test'));
    }

    /** @test */
    public function it_uppers_capitalized_sentence()
    {
        $this->assertEquals('ANOTHER TEST', str_upper('Another Test'));
    }

    /** @test */
    public function it_uppers_mixed_sentence()
    {
        $this->assertEquals('ANOTHER TEST', str_upper('AnoTHer TeST'));
    }

    /** @test */
    public function it_uppers_lowercased_sentence()
    {
        $this->assertEquals('ANOTHER TEST', str_upper('another test'));
    }

    /** @test */
    public function it_uppers_mixed_sentence_with_special_chars()
    {
        $this->assertEquals('ANOTHER-TEST!', str_upper('AnoTHer-TeST!'));
    }
}
