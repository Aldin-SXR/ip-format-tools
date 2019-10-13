# IP Formatting Tools

This is a small collection of useful methods related to working with IP addresses. Right now, the library provides the ability to convert **both IPv4 and IPv6** addresses to long integers, as well as vice versa. Moreover, the library also provides a way to represent IPv4 addresses in IPv6 format (e.g. 34.26.0.75 => *::ffff:221a:4b*)

## Installation

The library is available via Composer.

`composer require aldin-sxr/ip-format-tools`

After installing, include `vendor/autoload.php` and the `IPFormat` namespace to your project.

```php
<?php

require_once 'vendor/autoload.php';
use IPFormat\IPFormat;
```

Please note that the library requires either the [GMP](https://www.php.net/manual/en/book.gmp.php) or [BCMath](https://www.php.net/manual/en/book.bc.php) extension for working with large integers (which are seen in IPv6). GMP is recommended, as it offers a better performance.

## Usage

The library offers **three main **methods****:
- `IPFormat::ip_to_long()`
- `IPFormat::long_to_ip()`
- `IPFormat::ipv4_to_ipv6()`

`ip_to_long()` takes an IPv4 or IPv6 address and returns a corresponding long integer.

```php
echo IPFormat::ip_to_long('89.0.245.117'); // 1493235061
echo IPFormat::ip_to_long('fd44:5ff2:3::76cd'); // 336649705122095386261522076515346446029
```

`long_to_ip()` takes a long integer and returns a corresponding IPv4 or IPv6 address.

```php
echo IPFormat::long_to_ip(45678892); // 2.185.1.44
echo IPFormat::long_to_ip('567235998141'); // ::84:11e6:71bd
```

`ipv4_to_ipv6()` takes an IPv4 address and returns in one of the three IPv6 formats. 

The `compressed` flag (default) returns a **compressed** IPv6 address (leading zeroes are ommitted, and groups of zeroes are replaced with `::`). The `shortened` flag shortens groups of zeroes to a single zero, but does not omit groups from the address. The `expanded` flag returns the **full, expanded** IPv6 address.

```php
echo IPFormat::ipv4_to_ipv6('34.26.0.75', 'compressed'); // ::ffff:221a:4b
echo IPFormat::ipv4_to_ipv6('34.26.0.75', 'shortened'); // 0:0:0:0:0:ffff:221a:004b
echo IPFormat::ipv4_to_ipv6('34.26.0.75', 'expanded'); // 0000:0000:0000:0000:0000:ffff:221a:004b
```

## Documentation

Library documentation was generated using [phpDocumentor](https://www.phpdoc.org/), and is available at:

## Testing

All library methods come with several unit tests in [PHPUnit](https://phpunit.de/), which are available under `tests/unit`.

## License
The library is licensed under the [MIT](http://www.opensource.org/licenses/mit-license.php) license. See the [LICENSE](https://github.com/Aldin-SXR/ip-format-tools/blob/master/LICENSE) file for details.
