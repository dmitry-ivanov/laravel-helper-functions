<?php

namespace Illuminated\Helpers\Tests\email;

use Illuminated\Helpers\Tests\TestCase;
use PHPUnit\Framework\Attributes\Test;
use StdClass;

class IsEmailTest extends TestCase
{
    #[Test]
    public function it_returns_false_for_null(): void
    {
        $this->assertFalse(is_email(null));
    }

    #[Test]
    public function it_returns_false_for_boolean_true(): void
    {
        $this->assertFalse(is_email(true));
    }

    #[Test]
    public function it_returns_false_for_boolean_false(): void
    {
        $this->assertFalse(is_email(false));
    }

    #[Test]
    public function it_returns_false_for_integer(): void
    {
        $this->assertFalse(is_email(123));
    }

    #[Test]
    public function it_returns_false_for_float(): void
    {
        $this->assertFalse(is_email(123.45));
    }

    #[Test]
    public function it_returns_false_for_empty_array(): void
    {
        $this->assertFalse(is_email([]));
    }

    #[Test]
    public function it_returns_false_for_array(): void
    {
        $this->assertFalse(is_email(['user@example.com']));
    }

    #[Test]
    public function it_returns_false_for_an_object(): void
    {
        $this->assertFalse(is_email(new StdClass()));
    }

    #[Test]
    public function it_returns_false_for_invalid_emails(): void
    {
        $this->assertFalse(is_email('user'));
        $this->assertFalse(is_email('user@'));
        $this->assertFalse(is_email('user@example'));
        $this->assertFalse(is_email('user@example.'));
    }

    #[Test]
    public function it_returns_true_for_valid_emails(): void
    {
        $this->assertTrue(is_email('user@example.com'));
        $this->assertTrue(is_email('user.name@example.com'));
        $this->assertTrue(is_email('user.name-long@example.com'));
    }
}
