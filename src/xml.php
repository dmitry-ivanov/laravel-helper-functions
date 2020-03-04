<?php

use Spatie\ArrayToXml\ArrayToXml;

if (!function_exists('xml_to_array')) {
    /**
     * Convert XML string to array.
     *
     * @param SimpleXMLElement|string $xml
     * @return array
     */
    function xml_to_array($xml)
    {
        if (!($xml instanceof SimpleXMLElement)) {
            $xml = new SimpleXMLElement($xml);
        }

        return json_decode(json_encode($xml), true);
    }
}

if (!function_exists('array_to_xml')) {
    /**
     * Convert array to XML string.
     *
     * @param array $array
     * @param string $rootElement
     * @param bool $replaceSpacesByUnderscoresInKeyNames
     * @return string
     */
    function array_to_xml(array $array, string $rootElement = '', bool $replaceSpacesByUnderscoresInKeyNames = true)
    {
        return ArrayToXml::convert($array, $rootElement, $replaceSpacesByUnderscoresInKeyNames);
    }
}
