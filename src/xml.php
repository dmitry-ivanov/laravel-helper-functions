<?php

if (!function_exists('xml_to_array')) {
    function xml_to_array($xml)
    {
        $xml = ($xml instanceof SimpleXMLElement) ? $xml : new SimpleXMLElement($xml);

        return json_decode(json_encode($xml), true);
    }
}
