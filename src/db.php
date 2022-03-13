<?php

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;

if (!function_exists('db_is_sqlite')) {
    /**
     * Check whether the default database connection driver is `sqlite` or not.
     */
    function db_is_sqlite(): bool
    {
        $connection = DB::getDefaultConnection();

        return Config::get("database.connections.{$connection}.driver") === 'sqlite';
    }
}

if (!function_exists('db_is_mysql')) {
    /**
     * Check whether the default database connection driver is `mysql` or not.
     */
    function db_is_mysql(): bool
    {
        $connection = DB::getDefaultConnection();

        return Config::get("database.connections.{$connection}.driver") === 'mysql';
    }
}

if (!function_exists('db_mysql_now')) {
    /**
     * Get the current MySQL datetime.
     */
    function db_mysql_now(): string
    {
        return DB::selectOne('select now() as now')->now;
    }
}

if (!function_exists('db_mysql_variable')) {
    /**
     * Get value of the specified MySQL variable.
     */
    function db_mysql_variable(string $name): string|false
    {
        return DB::selectOne('show variables where variable_name = ?', [$name])->Value ?? false;
    }
}
