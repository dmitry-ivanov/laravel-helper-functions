<?php

use Symfony\Component\VarDumper\Cloner\VarCloner;
use Symfony\Component\VarDumper\Dumper\CliDumper;

if (!function_exists('get_dump')) {
    function get_dump($var)
    {
        $cloner = new VarCloner();
        $cloner->setMaxItems(-1);
        $cloner->setMaxString(-1);

        $cloned = $cloner->cloneVar($var);
        $cloned->withMaxDepth(-1);
        $cloned->withMaxItemsPerDepth(-1);
        $cloned->withRefHandles(-1);

        $dumper = new CliDumper();
        $dumper->setIndentPad('    ');
        $output = fopen('php://memory', 'r+b');
        $dumper->dump($cloned, $output);

        return stream_get_contents($output, -1, 0);
    }
}
