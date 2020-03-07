<?php

namespace Illuminated\Helpers\Artisan;

use Illuminate\Support\Collection;
use Symfony\Component\Process\PhpExecutableFinder;

class BackgroundCommand
{
    /**
     * The artisan command.
     *
     * @var string
     */
    private $command;

    /**
     * The command which should be executed before.
     *
     * @var string
     */
    private $before;

    /**
     * The command which should be executed after.
     *
     * @var string
     */
    private $after;

    /**
     * Create background command by the given parameters.
     *
     * @param string $command
     * @param string $before
     * @param string $after
     * @return \Illuminated\Helpers\Artisan\BackgroundCommand
     */
    public static function factory(string $command, string $before = '', string $after = '')
    {
        return new self($command, $before, $after);
    }

    /**
     * Create a new instance of the background command.
     *
     * @param string $command
     * @param string $before
     * @param string $after
     * @return void
     */
    public function __construct(string $command, string $before = '', string $after = '')
    {
        $this->command = $command;
        $this->before = $before;
        $this->after = $after;
    }

    /**
     * Run the command in background.
     *
     * @return void
     */
    public function run()
    {
        $command = $this->composeCommand();

        $command = is_windows_os()
            ? "start /B {$command}"
            : "({$command}) > /dev/null 2>&1 &";

        exec($command);
    }

    /**
     * Compose the command.
     *
     * @return string
     */
    protected function composeCommand()
    {
        return collect()
            ->when($this->before, function (Collection $collection) {
                return $collection->push($this->before);
            })
            ->push("{$this->getPhpExecutable()} {$this->getArtisan()} {$this->command}")
            ->when($this->after, function (Collection $collection) {
                return $collection->push($this->after);
            })
            ->implode(' && ');
    }

    /**
     * Get the path to PHP executable.
     *
     * @return string
     */
    protected function getPhpExecutable()
    {
        return (new PhpExecutableFinder)->find();
    }

    /**
     * Get the path to artisan.
     *
     * @return string
     */
    protected function getArtisan()
    {
        return defined('ARTISAN_BINARY') ? ARTISAN_BINARY : 'artisan';
    }
}
