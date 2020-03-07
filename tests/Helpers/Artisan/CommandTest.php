<?php

namespace Illuminated\Helpers\Artisan;

use Illuminated\Helpers\Tests\TestCase;

class CommandTest extends TestCase
{
    /**
     * This method is called before each test.
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();

        $phpBinaryMock = mock('overload:Symfony\Component\Process\PhpExecutableFinder');
        $phpBinaryMock->expects('find')->andReturn('php');
    }

    /** @test */
    public function only_one_constructor_argument_is_required()
    {
        $command = new BackgroundCommand('test');
        $this->assertInstanceOf(BackgroundCommand::class, $command);
    }

    /** @test */
    public function it_has_static_constructor_named_factory()
    {
        $command = BackgroundCommand::factory('test');
        $this->assertInstanceOf(BackgroundCommand::class, $command);
    }

    /**
     * @test
     * @runInSeparateProcess
     * @preserveGlobalState disabled
     */
    public function it_can_run_command_in_background()
    {
        $this->expectsExecWith('(php artisan test:command) > /dev/null 2>&1 &');

        BackgroundCommand::factory('test:command')->run();
    }

    /** @test */
    public function which_also_works_for_windows()
    {
        require_once 'mocks.php';

        $this->emulateWindowsOs();
        $this->expectsExecWith('start /B php artisan test:command');

        BackgroundCommand::factory('test:command')->run();
    }

    /**
     * @test
     * @runInSeparateProcess
     * @preserveGlobalState disabled
     */
    public function run_in_background_supports_the_before_command()
    {
        $this->expectsExecWith('(before command && php artisan test:command) > /dev/null 2>&1 &');

        BackgroundCommand::factory('test:command', 'before command')->run();
    }

    /**
     * @test
     * @runInSeparateProcess
     * @preserveGlobalState disabled
     */
    public function run_in_background_supports_the_after_command()
    {
        $this->expectsExecWith('(php artisan test:command && after command) > /dev/null 2>&1 &');

        BackgroundCommand::factory('test:command', '', 'after command')->run();
    }

    /**
     * @test
     * @runInSeparateProcess
     * @preserveGlobalState disabled
     */
    public function run_in_background_supports_the_before_and_after_commands_together()
    {
        $this->expectsExecWith('(before && php artisan test:command && after) > /dev/null 2>&1 &');

        BackgroundCommand::factory('test:command', 'before', 'after')->run();
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
        BackgroundCommand::factory('test:command', 'before', 'after')->run();
    }
}

if (!function_exists(__NAMESPACE__ . '\exec')) {
    /**
     * Mock for the `exec` function.
     *
     * @param string $command
     * @return mixed
     *
     * @noinspection PhpUndefinedMethodInspection
     */
    function exec(string $command)
    {
        return TestCase::$functions->exec($command);
    }
}
