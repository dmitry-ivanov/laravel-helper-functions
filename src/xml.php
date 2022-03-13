<?php

use Spatie\ArrayToXml\ArrayToXml;

if (!function_exists('xml_to_array')) {
    /**
     * Convert the given XML to array.
     */
    function xml_to_array(SimpleXMLElement|string $xml): array
    {
        if (!($xml instanceof SimpleXMLElement)) {
            $xml = new SimpleXMLElement($xml);
        }

        return json_decode(json_encode($xml), true);
    }
}

if (!function_exists('array_to_xml')) {
    /**
     * Convert the given array to XML string.
     */
    function array_to_xml(array $array, string $rootElement = '', bool $replaceSpacesByUnderscoresInKeyNames = true, string $xmlEncoding = 'utf-8'): string
    {
        return ArrayToXml::convert($array, $rootElement, $replaceSpacesByUnderscoresInKeyNames, $xmlEncoding);
    }
}
