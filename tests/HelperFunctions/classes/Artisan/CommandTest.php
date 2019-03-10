<?php

namespace Illuminated\Helpers\Artisan;

use Illuminated\Helpers\HelperFunctions\Tests\TestCase;

class CommandTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $phpBinaryMock = mock('overload:Symfony\Component\Process\PhpExecutableFinder');
        $phpBinaryMock->expects()->find()->andReturn('php');
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

    /**
     * @test
     * @runInSeparateProcess
     * @preserveGlobalState disabled
     */
    public function it_can_run_command_in_background()
    {
        $this->expectsExecWith('(php artisan test:command) > /dev/null 2>&1 &');

        $command = Command::factory('test:command');
        $command->runInBackground();
    }

    /** @test */
    public function which_also_works_for_windows()
    {
        require_once 'mocks.php';

        $this->emulateWindowsOs();
        $this->expectsExecWith('start /B php artisan test:command');

        $command = Command::factory('test:command');
        $command->runInBackground();
    }

    /**
     * @test
     * @runInSeparateProcess
     * @preserveGlobalState disabled
     */
    public function run_in_background_supports_before_subcommand()
    {
        $this->expectsExecWith('(before command && php artisan test:command) > /dev/null 2>&1 &');

        $command = Command::factory('test:command', 'before command');
        $command->runInBackground();
    }

    /**
     * @test
     * @runInSeparateProcess
     * @preserveGlobalState disabled
     */
    public function run_in_background_supports_after_subcommand()
    {
        $this->expectsExecWith('(php artisan test:command && after command) > /dev/null 2>&1 &');

        $command = Command::factory('test:command', null, 'after command');
        $command->runInBackground();
    }

    /**
     * @test
     * @runInSeparateProcess
     * @preserveGlobalState disabled
     */
    public function run_in_background_supports_before_and_after_subcommands_together()
    {
        $this->expectsExecWith('(before && php artisan test:command && after) > /dev/null 2>&1 &');

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
        $this->expectsExecWith('(before && php custom-artisan test:command && after) > /dev/null 2>&1 &');

        define('ARTISAN_BINARY', 'custom-artisan');
        $command = Command::factory('test:command', 'before', 'after');
        $command->runInBackground();
    }
}

if (!function_exists(__NAMESPACE__ . '\exec')) {
    function exec($command)
    {
        return TestCase::$functions->exec($command);
    }
}
