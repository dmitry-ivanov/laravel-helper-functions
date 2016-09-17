<?php

use Symfony\Component\Finder\Finder;

$files = Finder::create()
    ->files()
    ->in(__DIR__)
    ->depth(0)
    ->name('*.php')
    ->notName('autoload.php');

foreach ($files as $file) {
    dump((string)$file);
    require_once $file;
}
