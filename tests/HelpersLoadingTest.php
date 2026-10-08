<?php

namespace Illuminated\Helpers\Tests;

use PHPUnit\Framework\Attributes\Test;
use Symfony\Component\Finder\Finder;

class HelpersLoadingTest extends TestCase
{
    #[Test]
    public function it_can_load_helpers_again_without_redeclaring_functions(): void
    {
        /** @noinspection PotentialMalwareInspection */
        $before = get_defined_functions()['user'];

        $files = Finder::create()
            ->files()
            ->in(__DIR__.'/../src')
            ->depth(0)
            ->name('*.php')
            ->notName('autoload.php');

        foreach ($files as $file) {
            require $file;
        }

        /** @noinspection PotentialMalwareInspection */
        $this->assertSame($before, get_defined_functions()['user']);
    }
}
