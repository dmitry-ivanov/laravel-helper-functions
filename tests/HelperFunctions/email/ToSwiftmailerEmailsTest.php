<?php

namespace Illuminated\Helpers\HelperFunctions\Tests\Email;

use Illuminated\Helpers\HelperFunctions\Tests\TestCase;

class ToSwiftmailerEmailsTest extends TestCase
{
    /** @test */
    public function it_returns_an_empty_array_for_empty_array()
    {
        $this->assertEquals([], to_swiftmailer_emails([]));
    }

    /** @test */
    public function it_supports_simplified_syntax_for_one_email()
    {
        $this->assertEquals(
            ['john.doe@example.com' => 'John Doe'],
            to_swiftmailer_emails(['address' => 'john.doe@example.com', 'name' => 'John Doe'])
        );
    }

    /** @test */
    public function it_supports_multiple_emails()
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

    /** @test */
    public function it_skips_items_with_empty_addresses()
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

    /** @test */
    public function it_skips_items_with_invalid_addresses()
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

    /** @test */
    public function name_is_optional_for_one_email()
    {
        $this->assertEquals(['john.doe@example.com'], to_swiftmailer_emails(['address' => 'john.doe@example.com']));
    }

    /** @test */
    public function name_is_optional_for_multiple_emails()
    {
        $this->assertEquals(
            [
                'john.doe@example.com',
                'jane.doe@example.com' => 'Jane Doe',
                'mary.doe@example.com',
            ],
            to_swiftmailer_emails([
                ['address' => 'john.doe@example.com'],
                ['address' => 'jane.doe@example.com', 'name' => 'Jane Doe'],
                ['address' => 'mary.doe@example.com'],
            ])
        );
    }
}
