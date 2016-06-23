# Laravel helper functions

[![StyleCI](https://styleci.io/repos/61384075/shield)](https://styleci.io/repos/61384075)
[![SensioLabsInsight](https://insight.sensiolabs.com/projects/df1af353-b377-4478-b57a-789d86eb35e9/mini.png)](https://insight.sensiolabs.com/projects/df1af353-b377-4478-b57a-789d86eb35e9)

Provides Laravel-specific and pure PHP helper functions.

## Dependencies
- `PHP >=5.4.0`
- `Laravel >=5.2`

## Usage

1. Install package through `composer`:
    ```shell
    composer require illuminated/helper-functions
    ```

2. That's it! Now you can use any of provided helper functions.

## Available functions

- [Dump](#dump)
    - [get_dump](#get_dump)

- [Json](#json)
    - [is_json](#is_json)

- [Laravel](#laravel)
    - [laravel_db_is_mysql](#laravel_db_is_mysql)
    - [laravel_db_mysql_now](#laravel_db_mysql_now)
    - [laravel_db_mysql_variable](#laravel_db_mysql_variable)

## Dump

#### `get_dump`

Returns nicely formatted string representation of the variable, using [Symfony VarDumper Component](http://symfony.com/doc/current/components/var_dumper/introduction.html) with all of it's benefits:
```php
$var = array(
    'a simple string' => 'in an array of 5 elements',
    'a float' => 1.0,
    'an integer' => 1,
    'a boolean' => true,
    'an empty array' => array(),
);
$dump = get_dump($var);

// array:5 [
//     "a simple string" => "in an array of 5 elements"
//     "a float" => 1.0
//     "an integer" => 1
//     "a boolean" => true
//     "an empty array" => []
// ]
```

## Json

#### `is_json`

Checks if specified variable is valid json-encoded string or not:
```php
$isJson = is_json('{"foo":1,"bar":2,"baz":3}');

// true
```

Function can return decoded json, if you pass the second `return` argument as `true`:
```php
$decoded = is_json('{"foo":1,"bar":2,"baz":3}', true);

// ['foo' => 1, 'bar' => 2, 'baz' => 3]
```

## Laravel

#### `laravel_db_is_mysql`

Checks if default database connection is `mysql` or not:
```php
if (laravel_db_is_mysql()) {
    // mysql-specific code here
}
```

#### `laravel_db_mysql_now`

Returns current database datetime string, using `mysql` connection:
```php
$now = laravel_db_mysql_now();

// 2016-06-23 15:23:16
```

#### `laravel_db_mysql_variable`

Returns value of specified `mysql` variable:
```php
$hostname = laravel_db_mysql_variable('hostname');

// localhost
```

If variable doesn't exist, `false` would be returned.
