<?php

namespace Illuminated\Helpers\Artisan;

use Symfony\Component\Process\PhpExecutableFinder;

class Command
{
    private $command;
    private $before;
    private $after;
    private $phpBinary;

    public function __construct($command, $before = null, $after = null)
    {
        $this->command = $command;
        $this->before = $before;
        $this->after = $after;
        $this->phpBinary = (new PhpExecutableFinder)->find();
    }

    public static function factory($command, $before = null, $after = null)
    {
        return new self($command, $before, $after);
    }

    public function runInBackground()
    {
        exec($this->composeForRunInBackground());
    }

    protected function composeForRunInBackground()
    {
        return "({$this->composeForRun()}) > /dev/null 2>&1 &";
    }

    protected function composeForRun()
    {
        $parts = [];

        if (!empty($this->before)) {
            $parts[] = (string) $this->before;
        }

        $parts[] = "{$this->phpBinary} {$this->getArtisan()} {$this->command}";

        if (!empty($this->after)) {
            $parts[] = (string) $this->after;
        }

        return implode(' && ', $parts);
    }

    protected function getArtisan()
    {
        return base_path(defined('ARTISAN_BINARY') ? ARTISAN_BINARY : 'artisan');
    }
}
