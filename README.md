# Laravel helper functions

[![SensioLabsInsight](https://insight.sensiolabs.com/projects/df1af353-b377-4478-b57a-789d86eb35e9/big.png)](https://insight.sensiolabs.com/projects/df1af353-b377-4478-b57a-789d86eb35e9)

[![StyleCI](https://styleci.io/repos/61384075/shield?branch=master&style=flat)](https://styleci.io/repos/61384075)
[![Build Status](https://travis-ci.org/dmitry-ivanov/laravel-helper-functions.svg?branch=master)](https://travis-ci.org/dmitry-ivanov/laravel-helper-functions)
[![Coverage Status](https://coveralls.io/repos/github/dmitry-ivanov/laravel-helper-functions/badge.svg?branch=master)](https://coveralls.io/github/dmitry-ivanov/laravel-helper-functions?branch=master)

[![Latest Stable Version](https://poser.pugx.org/illuminated/helper-functions/v/stable)](https://packagist.org/packages/illuminated/helper-functions)
[![Latest Unstable Version](https://poser.pugx.org/illuminated/helper-functions/v/unstable)](https://packagist.org/packages/illuminated/helper-functions)
[![Total Downloads](https://poser.pugx.org/illuminated/helper-functions/downloads)](https://packagist.org/packages/illuminated/helper-functions)
[![License](https://poser.pugx.org/illuminated/helper-functions/license)](https://packagist.org/packages/illuminated/helper-functions)

Provides Laravel-specific and pure PHP helper functions.

## Requirements

- `PHP >=5.6.4`
- `Laravel >=5.2`

## Usage

1. Install package through `composer`:

    ```shell
    composer require illuminated/helper-functions
    ```

2. That's it! Now you can use any of provided helper functions.

## Available functions

> New functions are always adding. Feel free to contribute.

- [Array](#array)
    - [array_except_value](#array_except_value)

- [Artisan](#artisan)
    - [call_in_background](#call_in_background)

- [Database](#database)
    - [db_is_mysql](#db_is_mysql)
    - [db_mysql_now](#db_mysql_now)
    - [db_mysql_variable](#db_mysql_variable)

- [Dump](#dump)
    - [get_dump](#get_dump)

- [Email](#email)
    - [is_email](#is_email)
    - [to_rfc2822_email](#to_rfc2822_email)
    - [to_swiftmailer_emails](#to_swiftmailer_emails)

- [Format](#format)
    - [format_bytes](#format_bytes)

- [Json](#json)
    - [is_json](#is_json)

- [Strings](#strings)
    - [str_lower](#str_lower)
    - [str_upper](#str_upper)

## Array

#### `array_except_value()`

Removes the given values from array:

```php
$array = ['foo', 'bar', 'baz'];
$array = array_except_value($array, 'baz');

// ['foo', 'bar']
```

```php
$array = ['foo', 'bar', 'baz'];
$array = array_except_value($array, ['bar', 'baz']);

// ['foo']
```

## Artisan

#### `call_in_background()`

Calls artisan console command in background, with optional `before` and `after` sub-commands:

```php
call_in_background('foo');

// "php artisan foo" would be called in background
```

```php
call_in_background('foo:bar baz', 'sleep 0.3');

// "sleep 0.3 && php artisan foo:bar baz" would be called in background
```

## Database

#### `db_is_mysql()`

Checks if default database connection is `mysql` or not:

```php
if (db_is_mysql()) {
    // mysql-specific code here
}
```

#### `db_mysql_now()`

Returns database datetime, using `mysql` connection:

```php
$now = db_mysql_now();

// 2016-06-23 15:23:16
```

#### `db_mysql_variable()`

Returns value of specified `mysql` variable, or `false` if variable doesn't exist:

```php
$hostname = db_mysql_variable('hostname');

// localhost
```

## Dump

#### `get_dump()`

Returns nicely formatted string representation of the variable, using [Symfony VarDumper Component](http://symfony.com/doc/current/components/var_dumper/introduction.html) with all of it's benefits:

```php
$array = [
    'a simple string' => 'in an array of 5 elements',
    'a float' => 1.0,
    'an integer' => 1,
    'a boolean' => true,
    'an empty array' => [],
];
$dump = get_dump($array);

// array:5 [
//     "a simple string" => "in an array of 5 elements"
//     "a float" => 1.0
//     "an integer" => 1
//     "a boolean" => true
//     "an empty array" => []
// ]
```

## Email

#### `is_email()`

Checks if specified string is valid email address or not:

```php
$isEmail = is_email('john.doe@example.com');

// true
```

#### `to_rfc2822_email()`

Converts addresses data to [RFC 2822](http://www.faqs.org/rfcs/rfc2822.html) string, suitable for PHP [mail()](http://ua2.php.net/manual/en/function.mail.php) function:

```php
$address = to_rfc2822_email([
    ['address' => 'john.doe@example.com', 'name' => 'John Doe'],
    ['address' => 'mary.smith@example.com'],
]);

// John Doe <john.doe@example.com>, mary.smith@example.com
```

Also supports simplified syntax for single address item:

```php
$address = to_rfc2822_email(['address' => 'john.doe@example.com', 'name' => 'John Doe']);

// John Doe <john.doe@example.com>
```

#### `to_swiftmailer_emails()`

Converts addresses data to format, which is suitable for [SwiftMailer library](http://swiftmailer.org/docs/messages.html):

```php
$addresses = to_swiftmailer_emails([
    ['address' => 'john.doe@example.com', 'name' => 'John Doe'],
    ['address' => 'mary.smith@example.com'],
]);

// ["john.doe@example.com" => "John Doe", "mary.smith@example.com"]
```

Also supports simplified syntax for single address item:

```php
$address = to_swiftmailer_emails(['address' => 'john.doe@example.com', 'name' => 'John Doe']);

// ["john.doe@example.com" => "John Doe"]
```

## Format

#### `format_bytes()`

Formats bytes into kilobytes, megabytes, gigabytes or terabytes, with specified precision:

```php
$formatted = format_bytes(3333333);

// 3.18 MB
```

## Json

#### `is_json()`

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

## Strings

#### `str_lower()`

Converts string to lowercase:

```php
$lower = str_lower('TeSt');

// test
```

#### `str_upper()`

Converts string to uppercase:

```php
$upper = str_upper('TeSt');

// TEST
```
