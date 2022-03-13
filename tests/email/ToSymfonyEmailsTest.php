<?php

namespace Illuminated\Helpers\Tests\email;

use Illuminated\Helpers\Tests\TestCase;

class ToSymfonyEmailsTest extends TestCase
{
    /** @test */
    public function it_returns_an_empty_array_for_an_empty_array()
    {
        $this->assertEquals([], to_symfony_emails([]));
    }

    /** @test */
    public function it_supports_simplified_syntax_for_one_email()
    {
        $this->assertEquals(
            ['John Doe <john.doe@example.com>'],
            to_symfony_emails(['address' => 'john.doe@example.com', 'name' => 'John Doe']),
        );
    }

    /** @test */
    public function it_supports_multiple_emails()
    {
        $this->assertEquals(
            ['John Doe <john.doe@example.com>', 'Jane Doe <jane.doe@example.com>', 'Mary Doe <mary.doe@example.com>'],
            to_symfony_emails([
                ['address' => 'john.doe@example.com', 'name' => 'John Doe'],
                ['address' => 'jane.doe@example.com', 'name' => 'Jane Doe'],
                ['address' => 'mary.doe@example.com', 'name' => 'Mary Doe'],
            ]),
        );
    }

    /** @test */
    public function it_skips_items_with_empty_addresses()
    {
        $this->assertEquals(
            ['John Doe <john.doe@example.com>', 'Mary Doe <mary.doe@example.com>'],
            to_symfony_emails([
                ['address' => 'john.doe@example.com', 'name' => 'John Doe'],
                ['address' => null, 'name' => 'Jane Doe'],
                ['address' => false, 'name' => 'Jane Doe'],
                ['address' => '', 'name' => 'Jane Doe'],
                ['name' => 'Fake Doe'],
                ['address' => 'mary.doe@example.com', 'name' => 'Mary Doe'],
            ]),
        );
    }

    /** @test */
    public function it_skips_items_with_invalid_addresses()
    {
        $this->assertEquals(
            ['John Doe <john.doe@example.com>', 'Vicky Doe <vicky.doe@example.com>'],
            to_symfony_emails([
                ['address' => 'john.doe@example.com', 'name' => 'John Doe'],
                ['address' => 'jane@', 'name' => 'Jane Doe'],
                ['address' => 'jane@example', 'name' => 'Jane Doe'],
                ['address' => 'vicky.doe@example.com', 'name' => 'Vicky Doe'],
                ['address' => null, 'name' => 'Jane Doe'],
            ]),
        );
    }

    /** @test */
    public function name_is_optional_for_one_email()
    {
        $this->assertEquals(['john.doe@example.com'], to_symfony_emails(['address' => 'john.doe@example.com']));
    }

    /** @test */
    public function name_is_optional_for_multiple_emails()
    {
        $this->assertEquals(
            ['John Doe <john.doe@example.com>', 'jane.doe@example.com', 'mary.doe@example.com'],
            to_symfony_emails([
                ['address' => 'john.doe@example.com', 'name' => 'John Doe'],
                ['address' => 'jane.doe@example.com'],
                ['address' => 'mary.doe@example.com'],
            ]),
        );
    }
}
