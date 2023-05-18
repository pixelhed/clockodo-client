# Clockodo Client Laravel Package

[![Latest Version on Packagist](https://img.shields.io/packagist/v/fs98/clockodo-client.svg?style=flat-square)](https://packagist.org/packages/fs98/clockodo-client)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/fs98/clockodo-client/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/fs98/clockodo-client/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/fs98/clockodo-client/fix-php-code-style-issues.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/fs98/clockodo-client/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/fs98/clockodo-client.svg?style=flat-square)](https://packagist.org/packages/fs98/clockodo-client)

The Clockodo Laravel Package is a convenient and easy-to-use integration that allows Laravel developers to seamlessly integrate Clockodo time tracking functionality into their Laravel applications. [Clockodo](https://www.clockodo.com/en/) is a popular time tracking and management tool that helps businesses track and manage their working hours efficiently.

This package provides a set of Laravel-specific features and utilities that simplify the process of integrating Clockodo into your Laravel application. It encapsulates the complexities of making API requests, handling responses, and provides a clean and intuitive interface for interacting with Clockodo from within Laravel.

## Features:

-   Seamless integration with Laravel applications.
-   Simplified API communication with Clockodo.
-   Laravel service provider for easy registration and configuration.
-   Wrapper classes and methods for common Clockodo operations.
-   Convenient configuration options for customizing behavior.
-   Comprehensive test suite for reliable functionality.

## Support Us

[<img src="https://raw.githubusercontent.com/spatie/.github/main/docs/images/spatie.png" width="219px" />](https://spatie.be/github-ad-click/clockodo-client)

We invest a lot of resources into creating [best in class open source packages](https://spatie.be/open-source). You can support us by [buying one of our paid products](https://spatie.be/open-source/support-us).

We highly appreciate you sending us a postcard from your hometown, mentioning which of our package(s) you are using. You'll find our address on [our contact page](https://spatie.be/about-us). We publish all received postcards on [our virtual postcard wall](https://spatie.be/open-source/postcards).

## Installation

You can install the package via composer:

```bash
composer require fs98/clockodo-client
```

You can publish and run the migrations with:

```bash
php artisan vendor:publish --tag="clockodo-client-migrations"
php artisan migrate
```

You can publish the config file with:

```bash
php artisan vendor:publish --tag="clockodo-client-config"
```

This is the contents of the published config file:

```php
return [

    /*
   * Mandatory headers for clockodo request authentication
   */
    'headers' => [
        'X-Clockodo-External-Application' => env('CLOCKODO_EXTERNAL_APPLICATION'),
        'X-ClockodoApiUser' => env('CLOCKODO_API_USER'),
        'X-ClockodoApiKey' => env('CLOCKODO_API_KEY'),
    ],

    /**
     * Official URL of the Clockodo API
     */
    'api_url' => env('CLOCKODO_API_URL', 'https://my.clockodo.com/api'),

    /*
   * List of clockodo absence <typ></typ>es
   */
    'absence_types' => [
        1 => 'Regular holiday',
        2 => 'Special leaves',
        3 => 'Reduction of overtime',
        4 => 'Sick day',
        5 => 'Sick day of a child',
        6 => 'School / further education',
        7 => 'Maternity protection',
        8 => 'Home office (planned hours are applied)',
        9 => 'Work out of office (planned hours are applied)',
        10 => 'Special leaves (unpaid)',
        11 => 'Sick day (unpaid)',
        12 => 'Sick day of a child (unpaid)',
        13 => 'Quarantine (only full days)',
        14 => 'Military / alternative service (only full days)',
        15 => 'Sick day (sickness benefit)',
    ],

    /*
   * List of clockodo absence statuses
   */
    'absence_statuses' => [
        0 => 'enquired/reported',
        1 => 'approved',
        2 => 'declined',
        3 => 'approval cancelled',
        4 => 'request cancelled',
    ],
];
```

Optionally, you can publish the views using

```bash
php artisan vendor:publish --tag="clockodo-client-views"
```

## Usage

```php
$clockodo = new Fs98\ClockodoClient\Clockodo();
return $absences = $clockodo->absences->get(2023);
```

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

-   [Fata Sefer](https://github.com/fs98)
-   [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
