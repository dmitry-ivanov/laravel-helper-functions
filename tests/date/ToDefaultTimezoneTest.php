<?php

use Illuminate\Support\Facades\Config;

class ToDefaultTimezoneTest extends TestCase
{
    /** @test */
    public function it_returns_the_value_itself_for_the_empty_values()
    {
        $this->assertNull(to_default_timezone(null));
        $this->assertFalse(to_default_timezone(false));
        $this->assertEquals('', to_default_timezone(''));
    }

    /** @test */
    public function it_converts_valid_datetime_string_to_default_timezone()
    {
        Config::shouldReceive('get')->with('app.timezone')->once()->andReturn('Europe/Kiev');

        $this->assertEquals('2017-02-28 16:05:01', to_default_timezone('2017-02-28T14:05:01Z'));
    }
}
