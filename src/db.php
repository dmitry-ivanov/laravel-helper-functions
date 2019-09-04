<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Config;

if (!function_exists('db_is_sqlite')) {
    function db_is_sqlite()
    {
        $connection = DB::getDefaultConnection();
        $driver = Config::get("database.connections.{$connection}.driver");

        return $driver === 'sqlite';
    }
}

if (!function_exists('db_is_mysql')) {
    function db_is_mysql()
    {
        $connection = DB::getDefaultConnection();
        $driver = Config::get("database.connections.{$connection}.driver");

        return $driver === 'mysql';
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
        return isset($result['Value']) ? $result['Value'] : false;
    }
}
