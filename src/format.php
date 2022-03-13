<?php

use Symfony\Component\VarDumper\Cloner\VarCloner;
use Symfony\Component\VarDumper\Dumper\CliDumper;

if (!function_exists('get_dump')) {
    /**
     * Get a nicely formatted string representation of the variable, using the Symfony VarDumper Component.
     *
     * @see https://symfony.com/doc/current/components/var_dumper/introduction.html
     */
    function get_dump(mixed $var): string
    {
        $cloner = new VarCloner();
        $cloner->setMaxItems(-1);
        $cloner->setMaxString(-1);

        $cloneVar = $cloner->cloneVar($var);
        $cloneVar = $cloneVar->withMaxDepth(50);
        $cloneVar = $cloneVar->withMaxItemsPerDepth(-1);
        $cloneVar = $cloneVar->withRefHandles(true);

        $dumper = new CliDumper();
        $dumper->setIndentPad('    ');
        $output = fopen('php://memory', 'r+b');
        $dumper->dump($cloneVar, $output);

        return stream_get_contents($output, -1, 0);
    }
}

if (!function_exists('format_bytes')) {
    /**
     * Format bytes into kilobytes, megabytes, gigabytes or terabytes.
     */
    function format_bytes(int $bytes, int $precision = 2): string
    {
        $units = ['B', 'KB', 'MB', 'GB', 'TB'];

        $bytes = max($bytes, 0);
        $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
        $pow = min($pow, count($units) - 1);
        $bytes /= 1024 ** $pow;

        return round($bytes, $precision) . ' ' . $units[$pow];
    }
}

if (!function_exists('format_xml')) {
    /**
     * Format the given XML string using new lines and indents.
     */
    function format_xml(string $xml): string
    {
        $dom = dom_import_simplexml(new SimpleXMLElement($xml))->ownerDocument;

        $dom->formatOutput = true;
        $dom->preserveWhiteSpace = false;

        return $dom->saveXML();
    }
}
