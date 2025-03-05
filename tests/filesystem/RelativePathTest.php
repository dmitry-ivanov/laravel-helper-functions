<?php

namespace Illuminated\Helpers\Tests\filesystem;

use Illuminated\Helpers\Tests\TestCase;
use PHPUnit\Framework\Attributes\Test;

class RelativePathTest extends TestCase
{
    #[Test]
    public function it_returns_relative_path_for_two_folders(): void
    {
        $path1 = realpath(__DIR__ . '/../../src/');
        $path2 = realpath(__DIR__ . '/../../tests/filesystem');

        $this->assertEquals('../../src/', relative_path($path1, $path2));
    }

    #[Test]
    public function it_correctly_works_with_params_which_are_relative_paths(): void
    {
        $path1 = __DIR__ . '/../../src/';
        $path2 = __DIR__ . '/../../tests/filesystem';

        $this->assertEquals('../../src/', relative_path($path1, $path2));
    }

    #[Test]
    public function it_correctly_works_for_the_same_folder(): void
    {
        $path1 = __DIR__;
        $path2 = __DIR__;

        $this->assertEquals('./', relative_path($path1, $path2));
    }

    #[Test]
    public function even_if_the_paths_are_relative_and_different(): void
    {
        $path1 = __DIR__;
        $path2 = __DIR__ . '/../../tests/filesystem';

        $this->assertEquals('./', relative_path($path1, $path2));
    }
}
