<?php

namespace Illuminated\Helpers\Tests\Email;

use Illuminated\Helpers\Tests\TestCase;
use StdClass;

class IsEmailTest extends TestCase
{
    /** @test */
    public function it_returns_false_for_null()
    {
        $this->assertFalse(is_email(null));
    }

    /** @test */
    public function it_returns_false_for_boolean_true()
    {
        $this->assertFalse(is_email(true));
    }

    /** @test */
    public function it_returns_false_for_boolean_false()
    {
        $this->assertFalse(is_email(false));
    }

    /** @test */
    public function it_returns_false_for_integer()
    {
        $this->assertFalse(is_email(123));
    }

    /** @test */
    public function it_returns_false_for_float()
    {
        $this->assertFalse(is_email(123.45));
    }

    /** @test */
    public function it_returns_false_for_empty_array()
    {
        $this->assertFalse(is_email([]));
    }

    /** @test */
    public function it_returns_false_for_array()
    {
        $this->assertFalse(is_email(['user@example.com']));
    }

    /** @test */
    public function it_returns_false_for_an_object()
    {
        $this->assertFalse(is_email(new StdClass()));
    }

    /** @test */
    public function it_returns_false_for_invalid_emails()
    {
        $this->assertFalse(is_email('user'));
        $this->assertFalse(is_email('user@'));
        $this->assertFalse(is_email('user@example'));
        $this->assertFalse(is_email('user@example.'));
    }

    /** @test */
    public function it_returns_true_for_valid_emails()
    {
        $this->assertTrue(is_email('user@example.com'));
        $this->assertTrue(is_email('user.name@example.com'));
        $this->assertTrue(is_email('user.name-long@example.com'));
    }
}
