# Eloquent Criteria

[![Latest Version on Packagist](https://img.shields.io/packagist/v/alex-storozhenko/eloquent-criteria.svg?style=flat-square)](https://packagist.org/packages/alex-storozhenko/eloquent-criteria)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/alex-storozhenko/eloquent-criteria/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/alex-storozhenko/eloquent-criteria/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/alex-storozhenko/eloquent-criteria/fix-php-code-style-issues.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/alex-storozhenko/eloquent-criteria/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/alex-storozhenko/eloquent-criteria.svg?style=flat-square)](https://packagist.org/packages/alex-storozhenko/eloquent-criteria)

This is a lightweight implementation of Criteria Builder for Eloquent.
It's like LEGO® for Eloquent Builder, providing easy decoupling and reuse of query modifiers.

Obviously, the main purpose is to modify the query in the specified way, 
since Criteria are very similar to Eloquent scopes, 
only with that they can be applied to different models in a program 
and encapsulate more complex conditions with additional logic in a pretty clean way.

## Installation

You can install the package via composer:

```bash
composer require alex-storozhenko/eloquent-criteria
```

You can publish the config file with:

```bash
php artisan vendor:publish --tag="eloquent-criteria-config"
```

This is the contents of the published config file:

```php
return [
    /*
    |--------------------------------------------------------------------------
    | Macro
    |--------------------------------------------------------------------------
    |
    | This option controls the ability to add a macro to the eloquent builder,
    | which allows, when enabled, to add criteria builder functionality to the eloquent
    | at the global level
    | methods criteriaQuery(), applyCriteria() will be added
    | to the Eloquent through the macro
    |
    */
    'macro_enabled' => env('ELOQUENT_CRITERIA_MACRO_ENABLED', false),
];

```

## Usage

```php
$eloquentCriteria = new AlexStorozhenko\EloquentCriteria();
echo $eloquentCriteria->echoPhrase('Hello, AlexStorozhenko!');
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

Please if you found any security issues, write the details to my email: [a.storozhenko@live.com](mailto:a.storozhenko@live.com)

## Credits

- [Alex Storozhenko](https://github.com/alex-storozhenko)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
