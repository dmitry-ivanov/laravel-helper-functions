<?php

namespace Illuminated\Helpers\Tests\Filesystem;

use Illuminated\Helpers\Tests\TestCase;

class RelativePathTest extends TestCase
{
    /** @test */
    public function it_returns_relative_path_for_two_folders()
    {
        $path1 = realpath(__DIR__ . '/../../src/');
        $path2 = realpath(__DIR__ . '/../../tests/filesystem');

        $this->assertEquals('../../src/', relative_path($path1, $path2));
    }

    /** @test */
    public function it_correctly_works_with_params_which_are_relative_paths()
    {
        $path1 = __DIR__ . '/../../src/';
        $path2 = __DIR__ . '/../../tests/filesystem';

        $this->assertEquals('../../src/', relative_path($path1, $path2));
    }

    /** @test */
    public function it_correctly_works_for_the_same_folder()
    {
        $path1 = __DIR__;
        $path2 = __DIR__;

        $this->assertEquals('./', relative_path($path1, $path2));
    }

    /** @test */
    public function even_if_the_paths_are_relative_and_different()
    {
        $path1 = __DIR__;
        $path2 = __DIR__ . '/../../tests/filesystem';

        $this->assertEquals('./', relative_path($path1, $path2));
    }
}
