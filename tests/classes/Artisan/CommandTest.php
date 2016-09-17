<?php

namespace Illuminated\Helpers\Artisan;

use PHPUnit_Framework_Error;
use TestCase;

class CommandTest extends TestCase
{
    /** @test */
    public function it_has_required_arguments()
    {
        $this->expectException(PHPUnit_Framework_Error::class);
        return new Command();
    }

    /** @test */
    public function it_has_one_required_argument_which_is_command()
    {
        $command = new Command('test');
        $this->assertInstanceOf(Command::class, $command);
    }

    /** @test */
    public function it_has_static_constructor_named_factory()
    {
        $command = Command::factory('test');
        $this->assertInstanceOf(Command::class, $command);
    }
}
