<?php

namespace Illuminated\Helpers\Artisan;

use Mockery;
use PHPUnit_Framework_Error;
use TestCase;

class CommandTest extends TestCase
{
    public static $functions;

    protected function setUp()
    {
        self::$functions = Mockery::mock();

        $phpBinaryMock = Mockery::mock('overload:Symfony\Component\Process\PhpExecutableFinder');
        $phpBinaryMock->shouldReceive('find')->withNoArgs()->zeroOrMoreTimes()->andReturn('php');
    }

    /** @test */
    public function it_can_not_be_initiated_without_constructor_arguments()
    {
        $this->expectException(PHPUnit_Framework_Error::class);
        return new Command();
    }

    /** @test */
    public function only_one_constructor_argument_is_required()
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
        $this->shouldReceiveExecCallOnceWith('(php artisan test:command) > /dev/null 2>&1 &');

        $command = Command::factory('test:command');
        $command->runInBackground();
    }

    /** @test */
    public function run_in_background_supports_before_subcommand()
    {
        $this->shouldReceiveExecCallOnceWith('(before command && php artisan test:command) > /dev/null 2>&1 &');

        $command = Command::factory('test:command', 'before command');
        $command->runInBackground();
    }

    /** @test */
    public function run_in_background_supports_after_subcommand()
    {
        $this->shouldReceiveExecCallOnceWith('(php artisan test:command && after command) > /dev/null 2>&1 &');

        $command = Command::factory('test:command', null, 'after command');
        $command->runInBackground();
    }

    /** @test */
    public function run_in_background_supports_before_and_after_subcommands_together()
    {
        $this->shouldReceiveExecCallOnceWith('(before && php artisan test:command && after) > /dev/null 2>&1 &');

        $command = Command::factory('test:command', 'before', 'after');
        $command->runInBackground();
    }

    /**
     * @test
     * @runInSeparateProcess
     * @preserveGlobalState disabled
     */
    public function it_supports_overriding_of_artisan_binary_through_constant()
    {
        $this->shouldReceiveExecCallOnceWith('(before && php custom-artisan test:command && after) > /dev/null 2>&1 &');

        define('ARTISAN_BINARY', 'custom-artisan');
        $command = Command::factory('test:command', 'before', 'after');
        $command->runInBackground();
    }

    private function shouldReceiveExecCallOnceWith($with)
    {
        self::$functions->shouldReceive('exec')->with($with)->once();
    }
}

function exec($command)
{
    return CommandTest::$functions->exec($command);
}
