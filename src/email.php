<?php

use Illuminate\Support\Arr;

if (!function_exists('is_email')) {
    /**
     * Check whether the given string is an email address or not.
     *
     * @param mixed $string
     * @return bool
     */
    function is_email($string)
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
     *
     * @param array $addresses
     * @return string
     */
    function to_rfc2822_email(array $addresses)
    {
        // Check if we're dealing with one address, without multiarray
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
     *
     * @param array $addresses
     * @return array
     */
    function to_swiftmailer_emails(array $addresses)
    {
        // Check if we're dealing with one address, without multiarray
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
