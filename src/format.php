<?php

use Symfony\Component\VarDumper\Cloner\VarCloner;
use Symfony\Component\VarDumper\Dumper\CliDumper;

if (!function_exists('get_dump')) {
    /**
     * Get nicely formatted string representation of the variable, using Symfony VarDumper Component.
     *
     * @see https://symfony.com/doc/current/components/var_dumper/introduction.html
     *
     * @param mixed $var
     * @return string
     */
    function get_dump($var)
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
     *
     * @param int $bytes
     * @param int $precision
     * @return string
     */
    function format_bytes(int $bytes, int $precision = 2)
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
     * Format XML string using new lines and indents.
     *
     * @param string $xml
     * @return string
     */
    function format_xml(string $xml)
    {
        $dom = dom_import_simplexml(new SimpleXMLElement($xml))->ownerDocument;

        $dom->formatOutput = true;
        $dom->preserveWhiteSpace = false;

        return $dom->saveXML();
    }
}
