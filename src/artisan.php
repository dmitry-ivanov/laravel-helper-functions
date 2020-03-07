<?php

use Illuminated\Helpers\Artisan\BackgroundCommand;

if (!function_exists('call_in_background')) {
    /**
     * Call the given artisan console command in background.
     *
     * Code execution continues immediately, without waiting for results.
     *
     * @param string $command
     * @param string $before
     * @param string $after
     * @return void
     */
    function call_in_background(string $command, string $before = '', string $after = '')
    {
        BackgroundCommand::factory($command, $before, $after)->run();
    }
}
