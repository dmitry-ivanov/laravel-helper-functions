<?php

use Illuminate\Support\Arr;

if (!function_exists('is_email')) {
    /**
     * Check whether the given string is an email address or not.
     */
    function is_email(mixed $string): bool
    {
        return (bool) filter_var($string, FILTER_VALIDATE_EMAIL);
    }
}

if (!function_exists('to_rfc2822_email')) {
    /**
     * Convert addresses data to `RFC 2822` string, suitable for PHP `mail()` function.
     *
     * @see http://faqs.org/rfcs/rfc2822.html
     * @see https://php.net/manual/en/function.mail.php
     */
    function to_rfc2822_email(array $addresses): string
    {
        $addresses = !empty($addresses['address']) ? [$addresses] : $addresses;

        return collect($addresses)
            ->map(function (array $item) {
                $name = Arr::get($item, 'name');
                $address = Arr::get($item, 'address');

                if (!is_email($address)) {
                    return false;
                }

                return $name ? "{$name} <{$address}>" : $address;
            })
            ->filter()
            ->implode(', ');
    }
}

if (!function_exists('to_swiftmailer_emails')) {
    /**
     * Convert addresses data to SwiftMailer-suitable format.
     *
     * @see https://swiftmailer.org/docs/messages.html
     */
    function to_swiftmailer_emails(array $addresses): array
    {
        $addresses = !empty($addresses['address']) ? [$addresses] : $addresses;

        return collect($addresses)
            ->mapWithKeys(function (array $item, int $key) {
                $name = Arr::get($item, 'name');
                $address = Arr::get($item, 'address');

                if (!is_email($address)) {
                    return [];
                }

                return $name ? [$address => $name] : [$key => $address];
            })
            ->filter()
            ->toArray();
    }
}

if (!function_exists('to_symfony_emails')) {
    /**
     * Convert addresses data to Symfony-suitable format.
     *
     * @see https://symfony.com/doc/current/mailer.html#email-addresses
     */
    function to_symfony_emails(array $addresses): array
    {
        $addresses = !empty($addresses['address']) ? [$addresses] : $addresses;

        return collect($addresses)
            ->map(function (array $item) {
                $name = Arr::get($item, 'name');
                $address = Arr::get($item, 'address');

                if (!is_email($address)) {
                    return false;
                }

                return $name ? "{$name} <{$address}>" : $address;
            })
            ->filter()
            ->values()
            ->toArray();
    }
}
