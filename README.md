# IsoFlags

[![License](https://poser.pugx.org/rteeom/isoflags/license)](https://packagist.org/packages/rteeom/isoflags)
[![Latest Stable Version](https://poser.pugx.org/rteeom/isoflags/v/stable)](https://packagist.org/packages/rteeom/isoflags)
[![Total Downloads](https://poser.pugx.org/rteeom/isoflags/downloads)](https://packagist.org/packages/rteeom/isoflags)
[![Tests](https://github.com/mainstreamer/isoflags/actions/workflows/tests.yml/badge.svg)](https://github.com/mainstreamer/isoflags/actions/workflows/tests.yml)
[![codecov](https://codecov.io/gh/mainstreamer/isoflags/branch/master/graph/badge.svg)](https://codecov.io/gh/mainstreamer/isoflags)
[![PHP Version](https://img.shields.io/badge/php-%3E%3D8.4-8892BF.svg)](https://php.net/)

A modern PHP library for generating emoji flags from ISO 3166-1 alpha-2 country codes and extended regional codes.

## Features

- Generate emoji flags from ISO 3166-1 alpha-2 country codes
- Support for extended regional codes (Kosovo, Ascension Island, etc.)
- Type-safe with PHP 8.4 enums
- Static and instance methods available
- Comprehensive test coverage
- Zero dependencies (except ext-mbstring)

## Requirements

- PHP 8.4 or higher
- ext-mbstring

## Installation

```bash
composer require rteeom/isoflags
```

## Usage

### Basic Usage

#### Static Methods (Recommended)

```php
use Rteeom\FlagsGenerator\FlagsGenerator;

// Get flag (throws exception on invalid code)
echo FlagsGenerator::getFlag('gb'); // 🇬🇧
echo FlagsGenerator::getFlag('ua'); // 🇺🇦

// Get flag or null (returns null on invalid code)
echo FlagsGenerator::getFlagOrNull('us'); // 🇺🇸
echo FlagsGenerator::getFlagOrNull('invalid'); // null
```

#### Instance Methods (Deprecated, will be removed in v2.0)

```php
use Rteeom\FlagsGenerator\FlagsGenerator;

$generator = new FlagsGenerator();

echo $generator->getEmojiFlag('gb'); // 🇬🇧
echo $generator->getEmojiFlagOrNull('ua'); // 🇺🇦
```

### Extended Codes

The library supports both ISO 3166-1 standard codes and extended regional codes:

```php
use Rteeom\FlagsGenerator\FlagsGenerator;
use Rteeom\FlagsGenerator\Enums\CodeSet;

// Standard ISO codes (default)
echo FlagsGenerator::getFlag('us', CodeSet::ISO3166); // 🇺🇸

// Extended codes (includes Kosovo, Ascension Island, etc.)
echo FlagsGenerator::getFlag('xk', CodeSet::EXTENDED); // 🇽🇰 (Kosovo)
echo FlagsGenerator::getFlag('ac', CodeSet::EXTENDED); // 🇦🇨 (Ascension Island)
```

#### Available Extended Codes

In addition to all ISO 3166-1 alpha-2 codes, the following extended codes are supported:

- `ac` - Ascension Island
- `dg` - Diego Garcia
- `ea` - Ceuta & Melilla
- `ic` - Canary Islands
- `ta` - Tristan da Cunha
- `xk` - Kosovo

### Get All Available Codes

```php
use Rteeom\FlagsGenerator\FlagsGenerator;
use Rteeom\FlagsGenerator\Enums\CodeSet;

// Get all ISO 3166-1 codes
$isoCodes = FlagsGenerator::getAvailableCodes(CodeSet::ISO3166);
// Returns: ['ad', 'ae', 'af', ...]

// Get all codes including extended ones
$allCodes = FlagsGenerator::getAvailableCodes(CodeSet::EXTENDED);
// Returns: ['ad', 'ae', 'af', ..., 'ac', 'dg', 'ea', 'ic', 'ta', 'xk']
```

### Validation

```php
use Rteeom\FlagsGenerator\CountryCodeValidator;
use Rteeom\FlagsGenerator\Enums\CodeSet;

// Validate ISO code
$isValid = CountryCodeValidator::isValidCountryCode('gb'); // true
$isValid = CountryCodeValidator::isValidCountryCode('invalid'); // false

// Validate with extended codes
$isValid = CountryCodeValidator::isValidCountryCode('xk', CodeSet::EXTENDED); // true
$isValid = CountryCodeValidator::isValidCountryCode('xk', CodeSet::ISO3166); // false
```

### Exception Handling

```php
use Rteeom\FlagsGenerator\FlagsGenerator;
use Rteeom\FlagsGenerator\Exceptions\FlagsGeneratorException;

try {
    $flag = FlagsGenerator::getFlag('invalid-code');
} catch (FlagsGeneratorException $e) {
    echo $e->getMessage(); // "Invalid country code given invalid-code"
}
```

## API Reference

### FlagsGenerator

#### Static Methods

- `getFlag(string $isoCode, CodeSet $codeSet = CodeSet::ISO3166): string`
  - Returns emoji flag for the given ISO code
  - Throws `FlagsGeneratorException` if code is invalid

- `getFlagOrNull(string $isoCode, CodeSet $codeSet = CodeSet::ISO3166): ?string`
  - Returns emoji flag or null if code is invalid
  - Safe alternative that doesn't throw exceptions

- `getAvailableCodes(CodeSet $codeSet = CodeSet::ISO3166): array`
  - Returns array of all available ISO codes for the specified code set

#### Instance Methods (Deprecated)

- `getEmojiFlag(string $isoCountryCode, CodeSet $codeSet = CodeSet::ISO3166): string`
  - Deprecated: Use static `getFlag()` instead
  - Will be removed in v2.0

- `getEmojiFlagOrNull(string $isoCode, CodeSet $codeSet = CodeSet::ISO3166): ?string`
  - Deprecated: Use static `getFlagOrNull()` instead
  - Will be removed in v2.0

### CountryCodeValidator

- `isValidCountryCode(string $isoCountryCode, CodeSet $codeSet = CodeSet::ISO3166): bool`
  - Validates if a country code is valid for the specified code set

### Enums

#### CodeSet

- `CodeSet::ISO3166` - Standard ISO 3166-1 alpha-2 codes only
- `CodeSet::EXTENDED` - ISO codes plus extended regional codes

## Development

### Install Dependencies

```bash
composer install
```

### Run Tests

```bash
./vendor/bin/phpunit
```

All tests must pass before releasing to production.

### Code Coverage

To generate code coverage reports locally, you need to install a coverage driver (PCOV or Xdebug):

```bash
# Install PCOV (recommended - faster)
pecl install pcov

# Or install Xdebug
pecl install xdebug
```

Then run tests with coverage:

```bash
# Generate HTML coverage report
./vendor/bin/phpunit --coverage-html coverage/html

# Generate text coverage report
./vendor/bin/phpunit --coverage-text

# Generate Clover XML (for CI/CD)
./vendor/bin/phpunit --coverage-clover coverage.xml
```

The HTML coverage report will be available at `coverage/html/index.html`.

**Note:** Code coverage is automatically generated and reported via GitHub Actions on every push and pull request.

## How It Works

The library converts two-letter country codes to emoji flags by transforming each letter into its corresponding Regional Indicator Symbol. The transformation works by:

1. Converting each letter to its Unicode Regional Indicator Symbol
2. Using HTML entity encoding and mbstring conversion
3. Regional Indicator Symbols (U+1F1E6 to U+1F1FF) combine to form flag emojis

For example, 'GB' becomes:
- G → 🇬 (U+1F1EC)
- B → 🇧 (U+1F1E7)
- Combined: 🇬🇧

## Changelog

See [CHANGELOG.md](CHANGELOG.md) for a detailed history of changes and version updates.

## License

MIT License. See [LICENSE](LICENSE) file for details.

## Contributing

Contributions are welcome! Please see [CONTRIBUTING.md](CONTRIBUTING.md) for detailed guidelines on:

- Setting up your development environment
- Running tests and code coverage
- Code quality standards
- Pull request process
- Commit message conventions

Please ensure all tests pass before submitting a pull request.

## Credits

- Author: Rteeom
- Email: mainstreamer@outlook.com

## Support

For issues and feature requests, please use the [GitHub issue tracker](https://github.com/mainstreamer/isoflags/issues).
