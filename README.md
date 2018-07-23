# Laravel Helper Functions

[<img src="https://user-images.githubusercontent.com/1286821/43083932-4915853a-8ea0-11e8-8983-db9e0f04e772.png" alt="Become a Patron" width="160" />](https://www.patreon.com/illuminated)

[![StyleCI](https://styleci.io/repos/61384075/shield?branch=5.3&style=flat)](https://styleci.io/repos/61384075)
[![Build Status](https://travis-ci.org/dmitry-ivanov/laravel-helper-functions.svg?branch=5.3)](https://travis-ci.org/dmitry-ivanov/laravel-helper-functions)
[![Coverage Status](https://coveralls.io/repos/github/dmitry-ivanov/laravel-helper-functions/badge.svg?branch=5.3)](https://coveralls.io/github/dmitry-ivanov/laravel-helper-functions?branch=5.3)

[![Latest Stable Version](https://poser.pugx.org/illuminated/helper-functions/v/stable)](https://packagist.org/packages/illuminated/helper-functions)
[![Latest Unstable Version](https://poser.pugx.org/illuminated/helper-functions/v/unstable)](https://packagist.org/packages/illuminated/helper-functions)
[![Total Downloads](https://poser.pugx.org/illuminated/helper-functions/downloads)](https://packagist.org/packages/illuminated/helper-functions)
[![License](https://poser.pugx.org/illuminated/helper-functions/license)](https://packagist.org/packages/illuminated/helper-functions)

Provides Laravel-specific and pure PHP helper functions.

| Laravel | Helper Functions                                                            |
| ------- | :-------------------------------------------------------------------------: |
| 5.1.*   | [5.1.*](https://github.com/dmitry-ivanov/laravel-helper-functions/tree/5.1) |
| 5.2.*   | [5.2.*](https://github.com/dmitry-ivanov/laravel-helper-functions/tree/5.2) |
| 5.3.*   | [5.3.*](https://github.com/dmitry-ivanov/laravel-helper-functions/tree/5.3) |
| 5.4.*   | [5.4.*](https://github.com/dmitry-ivanov/laravel-helper-functions/tree/5.4) |
| 5.5.*   | [5.5.*](https://github.com/dmitry-ivanov/laravel-helper-functions/tree/5.5) |

## Usage

1. Install package through `composer`:

    ```shell
    composer require "illuminated/helper-functions:5.3.*"
    ```

2. That's it! Now you can use any of provided helper functions.

## Available functions

> New functions are always adding. Feel free to contribute.

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

- [Filesystem](#filesystem)
    - [relative_path](#relative_path)

- [Format](#format)
    - [get_dump](#get_dump)
    - [format_bytes](#format_bytes)
    - [format_xml](#format_xml)

- [Json](#json)
    - [is_json](#is_json)

- [Strings](#strings)
    - [str_lower](#str_lower)
    - [str_upper](#str_upper)

- [Xml](#xml)
    - [xml_to_array](#xml_to_array)
    - [array_to_xml](#array_to_xml)

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

#### `multiarray_set()`

Sets a value for each item of multidimensional array using "dot" notation:

```php
$array = [
    ['name' => 'Mercedes-Benz', 'details' => ['type' => 'SUV']],
    ['name' => 'BMW', 'details' => ['type' => 'SUV']],
    ['name' => 'Porsche', 'details' => ['type' => 'SUV']],
];

multiarray_set($array, 'details.country', 'Germany');

// [
//     ['name' => 'Mercedes-Benz', 'details' => ['type' => 'SUV', 'country' => 'Germany']],
//     ['name' => 'BMW', 'details' => ['type' => 'SUV', 'country' => 'Germany']],
//     ['name' => 'Porsche', 'details' => ['type' => 'SUV', 'country' => 'Germany']],
// ]
```

#### `multiarray_sort_by()`

Sorts multidimensional array by multiple fields:

```php
$array = [
    ['name' => 'Mercedes-Benz', 'model' => 'GLS', 'price' => 120000],
    ['name' => 'Mercedes-Benz', 'model' => 'GLE Coupe', 'price' => 110000],
    ['name' => 'BMW', 'model' => 'X6', 'price' => 77000],
    ['name' => 'Porsche', 'model' => 'Cayenne', 'price' => 117000],
];
$sorted = multiarray_sort_by($array, 'name', 'model');

// [
//     ['name' => 'BMW', 'model' => 'X6', 'price' => 77000],
//     ['name' => 'Mercedes-Benz', 'model' => 'GLE Coupe', 'price' => 110000],
//     ['name' => 'Mercedes-Benz', 'model' => 'GLS', 'price' => 120000],
//     ['name' => 'Porsche', 'model' => 'Cayenne', 'price' => 117000],
// ]
```

Optionally, you can set required sort order:

```php
$array = [
    ['name' => 'Mercedes-Benz', 'model' => 'GLS', 'price' => 120000],
    ['name' => 'Mercedes-Benz', 'model' => 'GLE Coupe', 'price' => 110000],
    ['name' => 'BMW', 'model' => 'X6', 'price' => 77000],
    ['name' => 'Porsche', 'model' => 'Cayenne', 'price' => 117000],
];
$sorted = multiarray_sort_by($array, 'name', SORT_ASC, 'model', SORT_DESC);

// [
//     ['name' => 'BMW', 'model' => 'X6', 'price' => 77000],
//     ['name' => 'Mercedes-Benz', 'model' => 'GLS', 'price' => 120000],
//     ['name' => 'Mercedes-Benz', 'model' => 'GLE Coupe', 'price' => 110000],
//     ['name' => 'Porsche', 'model' => 'Cayenne', 'price' => 117000],
// ]
```

## Artisan

#### `call_in_background()`

Calls artisan console command in background. Code execution continues immediately, without waiting for results.

```php
call_in_background('report');

// "php artisan report" would be called in background
```

Optional `before` and `after` sub-commands can be set as a second and third parameters:

```php
call_in_background('report:monthly subscriptions', 'sleep 0.3');

// "sleep 0.3 && php artisan report:monthly subscriptions" would be called in background
```

## Database

#### `db_is_sqlite()`

Checks if default database connection driver is `sqlite` or not:

```php
if (db_is_sqlite()) {
    // sqlite-specific code here
}
```

#### `db_is_mysql()`

Checks if default database connection driver is `mysql` or not:

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

## Date

#### `to_default_timezone()`

Converts passed datetime string to default timezone, which is `app.timezone` config setting:

```php
$date = to_default_timezone('2017-02-28T14:05:01Z');

// 2017-02-28 16:05:01, assuming timezone is Europe/Kiev
```

## Debug

#### `backtrace_as_string()`

Returns backtrace without arguments as string:

```php
$backtrace = backtrace_as_string();

#0  backtrace_as_string() called at [/htdocs/example/routes/web.php:15]
#1  Illuminate\Routing\Router->{closure}() called at [/htdocs/example/vendor/laravel/framework/src/Illuminate/Routing/Route.php:189]
#2  Illuminate\Foundation\Http\Kernel->handle() called at [/htdocs/example/public/index.php:53]
```

#### `minimized_backtrace_as_string()`

Returns minimized backtrace as string:

```php
$backtrace = minimized_backtrace_as_string();

#0 /htdocs/example/routes/web.php:15
#1 /htdocs/example/vendor/laravel/framework/src/Illuminate/Routing/Route.php:189
#2 /htdocs/example/public/index.php:53
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

## Filesystem

#### `relative_path()`

Returns the relative path of a directory given another one:

```php
$path = relative_path('/var/www/htdocs', '/var/www/htdocs/example')

// '../'
```

You can pass relative paths as a parameters:

```php
$path = relative_path('/var/www/htdocs/example/public/../../', '/var/')

// 'www/htdocs/'
```

## Format

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

#### `format_bytes()`

Formats bytes into kilobytes, megabytes, gigabytes or terabytes, with specified precision:

```php
$formatted = format_bytes(3333333);

// 3.18 MB
```

#### `format_xml()`

Formats xml string using new lines and indents:

```php
$formatted = format_xml('<?xml version="1.0"?><root><task priority="low"><to>John</to><from>Jane</from><title>Go to the shop</title></task><task priority="medium"><to>John</to><from>Paul</from><title>Finish the report</title></task><task priority="high"><to>Jane</to><from>Jeff</from><title>Clean the house</title></task></root>');

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

## Xml

#### `xml_to_array()`

Converts xml string to array:

```php
$array = xml_to_array('<?xml version="1.0"?>
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

Alternatively, you can pass an instance of `SimpleXMLElement` object, to get the same results.

#### `array_to_xml()`

Converts array to xml string using [spatie/array-to-xml](https://github.com/spatie/array-to-xml) package:

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

// <?xml version="1.0"?>
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

## License

The MIT License. Please see [License File](LICENSE) for more information.

[<img src="https://user-images.githubusercontent.com/1286821/43086829-ff7c006e-8ea6-11e8-8b03-ecf97ca95b2e.png" alt="Support on Patreon" width="125" />](https://www.patreon.com/illuminated)
