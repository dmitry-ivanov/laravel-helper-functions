<?php

use Spatie\ArrayToXml\ArrayToXml;

if (!function_exists('xml_to_array')) {
    function xml_to_array($xml)
    {
        $xml = ($xml instanceof SimpleXMLElement) ? $xml : new SimpleXMLElement($xml);

        return json_decode(json_encode($xml), true);
    }
}

if (!function_exists('array_to_xml')) {
    function array_to_xml(array $array, $rootElementName = '', $replaceSpacesByUnderScoresInKeyNames = true)
    {
        return ArrayToXml::convert($array, $rootElementName, $replaceSpacesByUnderScoresInKeyNames);
    }
}
