<?php

namespace Illuminated\Helpers\Artisan;

use Mockery as m;
use PHPUnit_Framework_Error;
use TestCase;

class CommandTest extends TestCase
{
    public static $functions;

    protected function setUp()
    {
        self::$functions = m::mock();

        $phpBinaryMock = m::mock('overload:Symfony\Component\Process\PhpExecutableFinder');
        $phpBinaryMock->shouldReceive('find')->with(false)->zeroOrMoreTimes()->andReturn('php');

        $utilsMock = m::mock('alias:Symfony\Component\Process\ProcessUtils');
        $utilsMock->shouldReceive('escapeArgument')->withAnyArgs()->zeroOrMoreTimes()->andReturnUsing(function ($value) {
            return $value;
        });
    }

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

    /** @test */
    public function it_can_run_command_in_background()
    {
        self::$functions->shouldReceive('exec')->with("(php artisan test command) > /dev/null 2>&1 &")->once();

        $command = Command::factory('test command');
        $command->runInBackground();
    }
}

function exec($command)
{
    return CommandTest::$functions->exec($command);
}
