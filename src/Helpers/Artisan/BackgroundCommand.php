<?php

namespace Illuminated\Helpers\Artisan;

use Illuminate\Support\Collection;
use Symfony\Component\Process\PhpExecutableFinder;

class BackgroundCommand
{
    /**
     * The artisan command.
     */
    private string $command;

    /**
     * The command which should be executed before.
     */
    private string $before;

    /**
     * The command which should be executed after.
     */
    private string $after;

    /**
     * Create background command by the given parameters.
     */
    public static function factory(string $command, string $before = '', string $after = ''): self
    {
        return new self($command, $before, $after);
    }

    /**
     * Create a new instance of the background command.
     */
    public function __construct(string $command, string $before = '', string $after = '')
    {
        $this->command = $command;
        $this->before = $before;
        $this->after = $after;
    }

    /**
     * Run the command in background.
     */
    public function run(): void
    {
        $command = $this->composeCommand();

        $command = is_windows_os()
            ? "start /B {$command}"
            : "({$command}) > /dev/null 2>&1 &";

        exec($command);
    }

    /**
     * Compose the command.
     */
    protected function composeCommand(): string
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
     */
    protected function getPhpExecutable(): string
    {
        return (new PhpExecutableFinder)->find();
    }

    /**
     * Get the path to artisan.
     */
    protected function getArtisan(): string
    {
        return defined('ARTISAN_BINARY') ? ARTISAN_BINARY : 'artisan';
    }
}
