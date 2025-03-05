<?php

namespace Illuminated\Helpers\Tests\email;

use Illuminated\Helpers\Tests\TestCase;
use PHPUnit\Framework\Attributes\Test;

class ToSwiftMailerEmailsTest extends TestCase
{
    #[Test]
    public function it_returns_an_empty_array_for_empty_array(): void
    {
        $this->assertEquals([], to_swiftmailer_emails([]));
    }

    #[Test]
    public function it_supports_simplified_syntax_for_one_email(): void
    {
        $this->assertEquals(
            ['john.doe@example.com' => 'John Doe'],
            to_swiftmailer_emails(['address' => 'john.doe@example.com', 'name' => 'John Doe'])
        );
    }

    #[Test]
    public function it_supports_multiple_emails(): void
    {
        $this->assertEquals(
            [
                'john.doe@example.com' => 'John Doe',
                'jane.doe@example.com' => 'Jane Doe',
                'mary.doe@example.com' => 'Mary Doe',
            ],
            to_swiftmailer_emails([
                ['address' => 'john.doe@example.com', 'name' => 'John Doe'],
                ['address' => 'jane.doe@example.com', 'name' => 'Jane Doe'],
                ['address' => 'mary.doe@example.com', 'name' => 'Mary Doe'],
            ])
        );
    }

    #[Test]
    public function it_skips_items_with_empty_addresses(): void
    {
        $this->assertEquals(
            [
                'john.doe@example.com' => 'John Doe',
                'mary.doe@example.com' => 'Mary Doe',
            ],
            to_swiftmailer_emails([
                ['address' => 'john.doe@example.com', 'name' => 'John Doe'],
                ['address' => null, 'name' => 'Jane Doe'],
                ['address' => false, 'name' => 'Jane Doe'],
                ['address' => '', 'name' => 'Jane Doe'],
                ['address' => 'mary.doe@example.com', 'name' => 'Mary Doe'],
                ['name' => 'Jane Doe'],
            ])
        );
    }

    #[Test]
    public function it_skips_items_with_invalid_addresses(): void
    {
        $this->assertEquals(
            [
                'john.doe@example.com' => 'John Doe',
                'jane.doe@example.com' => 'Jane Doe',
            ],
            to_swiftmailer_emails([
                ['address' => 'john.doe@example.com', 'name' => 'John Doe'],
                ['address' => 'mary.doe', 'name' => 'Mary Doe'],
                ['address' => 'mary.doe@', 'name' => 'Mary Doe'],
                ['address' => 'mary.doe@example', 'name' => 'Mary Doe'],
                ['address' => 'mary.doe@example.', 'name' => 'Mary Doe'],
                ['address' => 'jane.doe@example.com', 'name' => 'Jane Doe'],
            ])
        );
    }

    #[Test]
    public function name_is_optional_for_one_email(): void
    {
        $this->assertEquals(['john.doe@example.com'], to_swiftmailer_emails(['address' => 'john.doe@example.com']));
    }

    #[Test]
    public function name_is_optional_for_multiple_emails(): void
    {
        $this->assertEquals(
            [
                0 => 'john.doe@example.com',
                'jane.doe@example.com' => 'Jane Doe',
                2 => 'mary.doe@example.com',
            ],
            to_swiftmailer_emails([
                ['address' => 'john.doe@example.com'],
                ['address' => 'jane.doe@example.com', 'name' => 'Jane Doe'],
                ['address' => 'mary.doe@example.com'],
            ])
        );
    }
}
