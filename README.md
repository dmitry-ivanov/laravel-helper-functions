![Laravel-specific and pure PHP Helper Functions](art/1380x575-optimized.jpg)

# Laravel Helper Functions

[<img src="https://user-images.githubusercontent.com/1286821/43083932-4915853a-8ea0-11e8-8983-db9e0f04e772.png" alt="Become a Patron" width="160" />](https://patreon.com/dmitryivanov)

[![StyleCI](https://github.styleci.io/repos/61384075/shield?branch=9.x&style=flat)](https://github.styleci.io/repos/61384075?branch=9.x)
[![Build Status](https://img.shields.io/github/workflow/status/dmitry-ivanov/laravel-helper-functions/tests/9.x)](https://github.com/dmitry-ivanov/laravel-helper-functions/actions?query=workflow%3Atests+branch%3A9.x)
[![Coverage Status](https://img.shields.io/codecov/c/github/dmitry-ivanov/laravel-helper-functions/9.x)](https://app.codecov.io/gh/dmitry-ivanov/laravel-helper-functions/branch/9.x)

![Packagist Version](https://img.shields.io/packagist/v/illuminated/helper-functions)
![Packagist Stars](https://img.shields.io/packagist/stars/illuminated/helper-functions)
![Packagist Downloads](https://img.shields.io/packagist/dt/illuminated/helper-functions)
![Packagist License](https://img.shields.io/packagist/l/illuminated/helper-functions)

Laravel-specific and pure PHP Helper Functions.

| Laravel | Helper Functions                                                            |
|---------|-----------------------------------------------------------------------------|
| 9.x     | [9.x](https://github.com/dmitry-ivanov/laravel-helper-functions/tree/9.x)   |
| 8.x     | [8.x](https://github.com/dmitry-ivanov/laravel-helper-functions/tree/8.x)   |
| 7.x     | [7.x](https://github.com/dmitry-ivanov/laravel-helper-functions/tree/7.x)   |
| 6.x     | [6.x](https://github.com/dmitry-ivanov/laravel-helper-functions/tree/6.x)   |
| 5.8.*   | [5.8.*](https://github.com/dmitry-ivanov/laravel-helper-functions/tree/5.8) |
| 5.7.*   | [5.7.*](https://github.com/dmitry-ivanov/laravel-helper-functions/tree/5.7) |
| 5.6.*   | [5.6.*](https://github.com/dmitry-ivanov/laravel-helper-functions/tree/5.6) |
| 5.5.*   | [5.5.*](https://github.com/dmitry-ivanov/laravel-helper-functions/tree/5.5) |
| 5.4.*   | [5.4.*](https://github.com/dmitry-ivanov/laravel-helper-functions/tree/5.4) |
| 5.3.*   | [5.3.*](https://github.com/dmitry-ivanov/laravel-helper-functions/tree/5.3) |
| 5.2.*   | [5.2.*](https://github.com/dmitry-ivanov/laravel-helper-functions/tree/5.2) |
| 5.1.*   | [5.1.*](https://github.com/dmitry-ivanov/laravel-helper-functions/tree/5.1) |

## Usage

1. Install the package via Composer:

    ```shell script
    composer require "illuminated/helper-functions:^9.0"
    ```

2. Use any of the provided helper functions:

    ```php
    if (is_windows_os()) {
        call_in_background('switch-to-mac');
    }
    ```

## Available functions

> Feel free to contribute.

- [Array](#array)
    - [array_except_value](#array_except_value)
    - [multiarray_set](#multiarray_set)
    - [multiarray_sort_by](#multiarray_sort_by)

- [Artisan](#artisan)
    - [call_in_background](#call_in_background)

- [Database](#database)
    - [db_is_sqlite](#db_is_sqlite)
    - [db_is_mysql](#db_is_mysql)
    - [db_mysql_now](#db_mysql_now)
    - [db_mysql_variable](#db_mysql_variable)

- [Date](#date)
    - [to_default_timezone](#to_default_timezone)

- [Debug](#debug)
    - [backtrace_as_string](#backtrace_as_string)
    - [minimized_backtrace_as_string](#minimized_backtrace_as_string)

- [Email](#email)
    - [is_email](#is_email)
    - [to_rfc2822_email](#to_rfc2822_email)
    - [to_swiftmailer_emails](#to_swiftmailer_emails)
    - [to_symfony_emails](#to_symfony_emails)

- [Filesystem](#filesystem)
    - [relative_path](#relative_path)

- [Format](#format)
    - [get_dump](#get_dump)
    - [format_bytes](#format_bytes)
    - [format_xml](#format_xml)

- [Json](#json)
    - [is_json](#is_json)

- [System](#system)
    - [is_windows_os](#is_windows_os)

- [Xml](#xml)
    - [xml_to_array](#xml_to_array)
    - [array_to_xml](#array_to_xml)

## Array

#### `array_except_value()`

Remove the given values from the array:

```php
array_except_value(['foo', 'bar', 'baz'], 'baz');

// ["foo", "bar"]
```

```php
array_except_value(['foo', 'bar', 'baz'], ['bar', 'baz']);

// ["foo"]
```

#### `multiarray_set()`

Set the value for each item of the multidimensional array using "dot" notation:

```php
$array = [
    ['name' => 'Mercedes-Benz', 'details' => ['type' => 'SUV']],
    ['name' => 'BMW', 'details' => ['type' => 'SUV']],
    ['name' => 'Porsche', 'details' => ['type' => 'SUV']],
];

multiarray_set($array, 'details.country', 'Germany');

// [
//     ["name" => "Mercedes-Benz", "details" => ["type" => "SUV", "country" => "Germany"]],
//     ["name" => "BMW", "details" => ["type" => "SUV", "country" => "Germany"]],
//     ["name" => "Porsche", "details" => ["type" => "SUV", "country" => "Germany"]],
// ]
```

#### `multiarray_sort_by()`

Sort the multidimensional array by several fields:

```php
$array = [
    ['name' => 'Mercedes-Benz', 'model' => 'GLS', 'price' => 120000],
    ['name' => 'Mercedes-Benz', 'model' => 'GLE Coupe', 'price' => 110000],
    ['name' => 'BMW', 'model' => 'X6', 'price' => 77000],
    ['name' => 'Porsche', 'model' => 'Cayenne', 'price' => 117000],
];

$sorted = multiarray_sort_by($array, 'name', 'model');

// [
//     ["name" => "BMW", "model" => "X6", "price" => 77000],
//     ["name" => "Mercedes-Benz", "model" => "GLE Coupe", "price" => 110000],
//     ["name" => "Mercedes-Benz", "model" => "GLS", "price" => 120000],
//     ["name" => "Porsche", "model" => "Cayenne", "price" => 117000],
// ]
```

Also, you can change the sort order:

```php
$array = [
    ['name' => 'Mercedes-Benz', 'model' => 'GLS', 'price' => 120000],
    ['name' => 'Mercedes-Benz', 'model' => 'GLE Coupe', 'price' => 110000],
    ['name' => 'BMW', 'model' => 'X6', 'price' => 77000],
    ['name' => 'Porsche', 'model' => 'Cayenne', 'price' => 117000],
];

$sorted = multiarray_sort_by($array, 'name', SORT_ASC, 'model', SORT_DESC);

// [
//     ["name" => "BMW", "model" => "X6", "price" => 77000],
//     ["name" => "Mercedes-Benz", "model" => "GLS", "price" => 120000],
//     ["name" => "Mercedes-Benz", "model" => "GLE Coupe", "price" => 110000],
//     ["name" => "Porsche", "model" => "Cayenne", "price" => 117000],
// ]
```

## Artisan

#### `call_in_background()`

Call the given artisan console command in background.

Code execution continues immediately, without waiting for results.

```php
call_in_background('report');

// "php artisan report" would be called in background
```

Optional `before` and `after` sub-commands could be used:

```php
call_in_background('report:monthly subscriptions', 'sleep 0.3');

// "sleep 0.3 && php artisan report:monthly subscriptions" would be called in background
```

## Database

#### `db_is_sqlite()`

Check whether the default database connection driver is `sqlite` or not:

```php
db_is_sqlite();

// false
```

#### `db_is_mysql()`

Check whether the default database connection driver is `mysql` or not:

```php
db_is_mysql();

// true
```

#### `db_mysql_now()`

Get the current MySQL datetime:

```php
db_mysql_now();

// "2020-05-25 20:09:33"
```

#### `db_mysql_variable()`

Get value of the specified MySQL variable:

```php
db_mysql_variable('hostname');

// "localhost"
```

## Date

#### `to_default_timezone()`

Convert the given datetime to the default timezone (see `app.timezone` config):

```php
to_default_timezone('2017-02-28T14:05:01Z');

// "2017-02-28 16:05:01", assuming that `app.timezone` is "Europe/Kiev"
```

## Debug

#### `backtrace_as_string()`

Get backtrace without arguments, as a string:

```php
$backtrace = backtrace_as_string();

#0  backtrace_as_string() called at [/htdocs/example/routes/web.php:15]
#1  Illuminate\Routing\Router->{closure}() called at [/htdocs/example/vendor/laravel/framework/src/Illuminate/Routing/Route.php:189]
#2  Illuminate\Foundation\Http\Kernel->handle() called at [/htdocs/example/public/index.php:53]
```

#### `minimized_backtrace_as_string()`

Get minimized backtrace, as a string:

```php
$backtrace = minimized_backtrace_as_string();

#0 /htdocs/example/routes/web.php:15
#1 /htdocs/example/vendor/laravel/framework/src/Illuminate/Routing/Route.php:189
#2 /htdocs/example/public/index.php:53
```

## Email

#### `is_email()`

Check whether the given string is an email address or not:

```php
is_email('john.doe@example.com');

// true
```

#### `to_rfc2822_email()`

Convert addresses data to [RFC 2822](http://faqs.org/rfcs/rfc2822.html) string, suitable for PHP [mail()](https://php.net/manual/en/function.mail.php) function:

```php
to_rfc2822_email([
    ['address' => 'john.doe@example.com', 'name' => 'John Doe'],
    ['address' => 'jane.smith@example.com'],
]);

// "John Doe <john.doe@example.com>, jane.smith@example.com"
```

Also, it supports simplified syntax for a single address:

```php
to_rfc2822_email(['address' => 'john.doe@example.com', 'name' => 'John Doe']);

// "John Doe <john.doe@example.com>"
```

#### `to_swiftmailer_emails()`

Convert addresses data to [SwiftMailer-suitable format](https://swiftmailer.org/docs/messages.html):

```php
to_swiftmailer_emails([
    ['address' => 'john.doe@example.com', 'name' => 'John Doe'],
    ['address' => 'jane.smith@example.com'],
]);

// ["john.doe@example.com" => "John Doe", "jane.smith@example.com"]
```

Also, it supports simplified syntax for a single address:

```php
to_swiftmailer_emails(['address' => 'john.doe@example.com', 'name' => 'John Doe']);

// ["john.doe@example.com" => "John Doe"]
```

#### `to_symfony_emails()`

Convert addresses data to [Symfony-suitable format](https://symfony.com/doc/current/mailer.html#email-addresses):

```php
to_symfony_emails([
    ['address' => 'john.doe@example.com', 'name' => 'John Doe'],
    ['address' => 'jane.smith@example.com'],
]);

// ["John Doe <john.doe@example.com>", "jane.smith@example.com"]
```

Also, it supports simplified syntax for a single address:

```php
to_symfony_emails(['address' => 'john.doe@example.com', 'name' => 'John Doe']);

// ["John Doe <john.doe@example.com>"]
```

## Filesystem

#### `relative_path()`

Get a relative path for the given folders:

```php
relative_path('/var/www/htdocs', '/var/www/htdocs/example');

// "../"
```

You can pass the relative path as a parameter too:

```php
relative_path('/var/www/htdocs/example/public/../../', '/var/');

// "www/htdocs/"
```

## Format

#### `get_dump()`

Get a nicely formatted string representation of the variable, using the [Symfony VarDumper Component](https://symfony.com/doc/current/components/var_dumper/introduction.html):

```php
$array = [
    'a simple string' => 'Hello!',
    'a float' => 1.0,
    'an integer' => 1,
    'a boolean' => true,
    'an empty array' => [],
];

$dump = get_dump($array);

// array:5 [
//     "a simple string" => "Hello!"
//     "a float" => 1.0
//     "an integer" => 1
//     "a boolean" => true
//     "an empty array" => []
// ]
```

#### `format_bytes()`

Format bytes into kilobytes, megabytes, gigabytes or terabytes:

```php
format_bytes(3333333);

// "3.18 MB"
```

#### `format_xml()`

Format the given XML string using new lines and indents:

```php
format_xml('<?xml version="1.0"?><root><task priority="low"><to>John</to><from>Jane</from><title>Go to the shop</title></task><task priority="medium"><to>John</to><from>Paul</from><title>Finish the report</title></task><task priority="high"><to>Jane</to><from>Jeff</from><title>Clean the house</title></task></root>');

// <?xml version="1.0"?>
// <root>
//   <task priority="low">
//     <to>John</to>
//     <from>Jane</from>
//     <title>Go to the shop</title>
//   </task>
//   <task priority="medium">
//     <to>John</to>
//     <from>Paul</from>
//     <title>Finish the report</title>
//   </task>
//   <task priority="high">
//     <to>Jane</to>
//     <from>Jeff</from>
//     <title>Clean the house</title>
//   </task>
// </root>
```

## Json

#### `is_json()`

Check whether the given value is a valid JSON-encoded string or not:

```php
is_json('{"foo":1,"bar":2,"baz":3}');

// true
```

It returns decoded JSON if you pass `true` as a second argument:

```php
is_json('{"foo":1,"bar":2,"baz":3}', true);

// ["foo" => 1, "bar" => 2, "baz" => 3]
```

## System

#### `is_windows_os()`

Check whether the operating system is Windows or not:

```php
is_windows_os();

// false
```

## Xml

#### `xml_to_array()`

Convert the given XML to array:

```php
xml_to_array('<?xml version="1.0"?>
<Guys>
    <Good_guy Rating="100">
        <name>Luke Skywalker</name>
        <weapon>Lightsaber</weapon>
    </Good_guy>
    <Bad_guy Rating="90">
        <name>Sauron</name>
        <weapon>Evil Eye</weapon>
    </Bad_guy>
</Guys>
');

// [
//     "Good_guy" => [
//         "name" => "Luke Skywalker",
//         "weapon" => "Lightsaber",
//         "@attributes" => [
//             "Rating" => "100",
//         ],
//     ],
//     "Bad_guy" => [
//         "name" => "Sauron",
//         "weapon" => "Evil Eye",
//         "@attributes" => [
//             "Rating" => "90",
//         ],
//     ],
// ]
```

Alternatively, you can pass an instance of the `SimpleXMLElement` class instead of a string.

#### `array_to_xml()`

Convert the given array to XML string:

```php
$array = [
    'Good guy' => [
        'name' => 'Luke Skywalker',
        'weapon' => 'Lightsaber',
        '@attributes' => [
            'Rating' => '100',
        ],
    ],
    'Bad guy' => [
        'name' => 'Sauron',
        'weapon' => 'Evil Eye',
        '@attributes' => [
            'Rating' => '90',
        ],
    ]
];

$xml = array_to_xml($array, 'Guys');

// <?xml version="1.0" encoding="utf-8"?>
// <Guys>
//    <Good_guy Rating="100">
//        <name>Luke Skywalker</name>
//        <weapon>Lightsaber</weapon>
//    </Good_guy>
//    <Bad_guy Rating="90">
//        <name>Sauron</name>
//        <weapon>Evil Eye</weapon>
//    </Bad_guy>
// </Guys>
```

## Sponsors

[![Laravel Idea](art/sponsor-laravel-idea.png)](https://laravel-idea.com)

## License

Laravel Helper Functions is open-sourced software licensed under the [MIT license](LICENSE.md).

[<img src="https://user-images.githubusercontent.com/1286821/43086829-ff7c006e-8ea6-11e8-8b03-ecf97ca95b2e.png" alt="Support on Patreon" width="125" />](https://patreon.com/dmitryivanov)
