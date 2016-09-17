<?php

// class CallInBackgroundValidationsTest extends TestCase
// {
//     /** @test */
//     public function it_returns_false_for_an_empty_command()
//     {
//         $this->assertFalse(call_in_background(null));
//         $this->assertFalse(call_in_background(false));
//         $this->assertFalse(call_in_background(''));
//     }
//
//     /** @test */
//     public function it_returns_false_for_non_string_command()
//     {
//         $this->assertFalse(call_in_background(123));
//         $this->assertFalse(call_in_background(123.45));
//         $this->assertFalse(call_in_background(['array']));
//         $this->assertFalse(call_in_background(new StdClass()));
//     }
//
//     /** @test */
//     public function it_returns_false_for_non_string_before_parameter()
//     {
//         $this->assertFalse(call_in_background('command', 123));
//         $this->assertFalse(call_in_background('command', 123.45));
//         $this->assertFalse(call_in_background('command', ['array']));
//         $this->assertFalse(call_in_background('command', new StdClass()));
//     }
//
//     /** @test */
//     public function it_returns_false_for_non_string_after_parameter()
//     {
//         $this->assertFalse(call_in_background('command', null, 123));
//         $this->assertFalse(call_in_background('command', null, 123.45));
//         $this->assertFalse(call_in_background('command', null, ['array']));
//         $this->assertFalse(call_in_background('command', null, new StdClass()));
//     }
// }
