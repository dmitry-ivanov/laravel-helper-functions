<?php

use Illuminate\Support\Facades\DB;

if (!function_exists('db_is_mysql')) {
    function db_is_mysql()
    {
        return (DB::getDefaultConnection() == 'mysql');
    }
}

if (!function_exists('db_mysql_now')) {
    function db_mysql_now()
    {
        $result = (array) DB::selectOne('select now() as now');
        return $result['now'];
    }
}

if (!function_exists('db_mysql_variable')) {
    function db_mysql_variable($name)
    {
        $result = (array) DB::selectOne('show variables where variable_name = ?', [$name]);
        return (isset($result['Value']) ? $result['Value'] : false);
    }
}
