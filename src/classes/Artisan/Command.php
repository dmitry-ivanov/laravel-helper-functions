<?php

namespace Illuminated\Helpers\Artisan;

use Symfony\Component\Process\PhpExecutableFinder;
use Symfony\Component\Process\ProcessUtils;

class Command
{
    private $command;
    private $before;
    private $after;

    public function __construct($command, $before = null, $after = null)
    {
        $this->command = $command;
        $this->before = $before;
        $this->after = $after;
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

        $parts[] = "{$this->getPhpBinary()} {$this->getArtisan()} {$this->command}";

        if (!empty($this->after)) {
            $parts[] = (string) $this->after;
        }

        return implode(' && ', $parts);
    }

    protected function getPhpBinary()
    {
        $finder = new PhpExecutableFinder();
        $phpBinary = $finder->find(false);

        $phpBinary = ProcessUtils::escapeArgument($phpBinary);
        if (defined('HHVM_VERSION')) {
            $phpBinary .= ' --php';
        }

        return $phpBinary;
    }

    protected function getArtisan()
    {
        $artisan = 'artisan';
        if (defined('ARTISAN_BINARY')) {
            $artisan = ProcessUtils::escapeArgument(ARTISAN_BINARY);
        }

        return $artisan;
    }
}
