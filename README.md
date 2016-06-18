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

## Dump

#### `get_dump`

Lalala

## Json

#### `is_json`

Checks if specified variable is valid json-encoded string or not:
```php
$isJson = is_json('{"foo":1,"bar":2,"baz":3}');

// true
```

Boolean is returned by default, however, function can return decoded json, as associative array, if you pass the second `return` parameter as `true`:
```php
$decoded = is_json('{"foo":1,"bar":2,"baz":3}', true);

// ['foo' => 1, 'bar' => 2, 'baz' => 3]
```
