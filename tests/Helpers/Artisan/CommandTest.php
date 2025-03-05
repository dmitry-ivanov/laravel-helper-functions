<?php

namespace Illuminated\Helpers\Artisan;

use Illuminated\Helpers\Tests\TestCase;
use PHPUnit\Framework\Attributes\PreserveGlobalState;
use PHPUnit\Framework\Attributes\RunInSeparateProcess;
use PHPUnit\Framework\Attributes\Test;

class CommandTest extends TestCase
{
    /**
     * This method is called before each test.
     */
    protected function setUp(): void
    {
        parent::setUp();

        $phpBinaryMock = mock('overload:Symfony\Component\Process\PhpExecutableFinder');
        $phpBinaryMock->expects('find')->andReturn('php');
    }

    #[Test]
    public function only_one_constructor_argument_is_required(): void
    {
        $command = new BackgroundCommand('test');
        $this->assertInstanceOf(BackgroundCommand::class, $command);
    }

    #[Test]
    public function it_has_static_constructor_named_factory(): void
    {
        $command = BackgroundCommand::factory('test'); /** @noinspection UnnecessaryAssertionInspection */
        $this->assertInstanceOf(BackgroundCommand::class, $command);
    }

    #[Test] #[RunInSeparateProcess] #[PreserveGlobalState(false)]
    public function it_can_run_command_in_background(): void
    {
        $this->expectsExecWith('(php artisan test:command) > /dev/null 2>&1 &');

        BackgroundCommand::factory('test:command')->run();
    }

    #[Test]
    public function which_also_works_for_windows(): void
    {
        require_once 'mocks.php';

        $this->emulateWindowsOs();
        $this->expectsExecWith('start /B php artisan test:command');

        BackgroundCommand::factory('test:command')->run();
    }

    #[Test] #[RunInSeparateProcess] #[PreserveGlobalState(false)]
    public function run_in_background_supports_the_before_command(): void
    {
        $this->expectsExecWith('(before command && php artisan test:command) > /dev/null 2>&1 &');

        BackgroundCommand::factory('test:command', 'before command')->run();
    }

    #[Test] #[RunInSeparateProcess] #[PreserveGlobalState(false)]
    public function run_in_background_supports_the_after_command(): void
    {
        $this->expectsExecWith('(php artisan test:command && after command) > /dev/null 2>&1 &');

        BackgroundCommand::factory('test:command', '', 'after command')->run();
    }

    #[Test] #[RunInSeparateProcess] #[PreserveGlobalState(false)]
    public function run_in_background_supports_the_before_and_after_commands_together(): void
    {
        $this->expectsExecWith('(before && php artisan test:command && after) > /dev/null 2>&1 &');

        BackgroundCommand::factory('test:command', 'before', 'after')->run();
    }

    #[Test] #[RunInSeparateProcess] #[PreserveGlobalState(false)]
    public function it_supports_overriding_of_artisan_binary_through_constant(): void
    {
        $this->expectsExecWith('(before && php custom-artisan test:command && after) > /dev/null 2>&1 &');

        define('ARTISAN_BINARY', 'custom-artisan');
        BackgroundCommand::factory('test:command', 'before', 'after')->run();
    }
}

if (!function_exists(__NAMESPACE__ . '\exec')) {
    /**
     * Mock for the `exec` function.
     */
    function exec(string $command): mixed
    {
        /** @noinspection PhpUndefinedMethodInspection */
        return TestCase::$functions->exec($command);
    }
}
