<?php

namespace Illuminated\Helpers\System;

class Command
{
    public static function exec($command, array &$output = null, &$return_var = null)
    {
        return exec($command, $output, $return_var);
    }
}
