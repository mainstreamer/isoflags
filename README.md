# IsoFlags

[![License](https://poser.pugx.org/rteeom/isoflags/license)](https://packagist.org/packages/rteeom/isoflags)
[![Latest Stable Version](https://poser.pugx.org/rteeom/isoflags/v/stable)](https://packagist.org/packages/rteeom/isoflags)
[![Total Downloads](https://poser.pugx.org/rteeom/isoflags/downloads)](https://packagist.org/packages/rteeom/isoflags)
[![Tests](https://github.com/mainstreamer/isoflags/actions/workflows/tests.yml/badge.svg)](https://github.com/mainstreamer/isoflags/actions/workflows/tests.yml)
[![codecov](https://codecov.io/gh/mainstreamer/isoflags/branch/master/graph/badge.svg)](https://codecov.io/gh/mainstreamer/isoflags)
[![PHP Version](https://img.shields.io/badge/php-%3E%3D8.4-8892BF.svg)](https://php.net/)

A modern PHP library for generating emoji flags from ISO 3166-1 alpha-2 country codes and extended regional codes.

## Features

- 🚀 Generate emoji flags from ISO country codes
- 🌍 Extended regional codes support (Kosovo, Ascension Island, etc.)
- 🛡️ Type-safe with PHP 8.4 enums
- ✅ 100% test coverage
- 📦 **Zero dependencies** - only requires PHP 8.4+

## Installation

```bash
composer require rteeom/isoflags
```

**Requirements:** PHP 8.4 or higher

## Quick Start

```php
use Rteeom\FlagsGenerator\FlagsGenerator;

// Generate emoji flags
echo FlagsGenerator::getFlag('gb'); // 🇬🇧
echo FlagsGenerator::getFlag('ua'); // 🇺🇦
echo FlagsGenerator::getFlag('us'); // 🇺🇸

// Safe usage (returns null for invalid codes)
$flag = FlagsGenerator::getFlagOrNull('invalid'); // null
```

### Extended Regional Codes

```php
use Rteeom\FlagsGenerator\FlagsGenerator;
use Rteeom\FlagsGenerator\Enums\CodeSet;

// Kosovo, Ascension Island, and more
echo FlagsGenerator::getFlag('xk', CodeSet::EXTENDED); // 🇽🇰
echo FlagsGenerator::getFlag('ac', CodeSet::EXTENDED); // 🇦🇨
```

### Validation

```php
use Rteeom\FlagsGenerator\CountryCodeValidator;

$isValid = CountryCodeValidator::isValidCountryCode('gb'); // true
$isValid = CountryCodeValidator::isValidCountryCode('invalid'); // false
```

## Documentation

📚 **[Read the full documentation →](https://mainstreamer.github.io/isoflags)**

- [Installation Guide](https://mainstreamer.github.io/isoflags/getting-started/installation/)
- [Quick Start](https://mainstreamer.github.io/isoflags/getting-started/quick-start/)
- [Usage Examples](https://mainstreamer.github.io/isoflags/usage/basic-usage/)
- [API Reference](https://mainstreamer.github.io/isoflags/api-reference/)
- [Extended Codes](https://mainstreamer.github.io/isoflags/usage/extended-codes/)

## Development

### Run Tests

```bash
./vendor/bin/phpunit
```

### Code Quality

```bash
make qa  # Run all quality checks
```

See [Contributing Guide](https://mainstreamer.github.io/isoflags/development/contributing/) for details.

## Changelog

See [CHANGELOG.md](CHANGELOG.md) for version history.

## License

MIT License - see [LICENSE](LICENSE) file for details.

## Contributing

Contributions are welcome! See [CONTRIBUTING.md](CONTRIBUTING.md) for guidelines.

## Support

- 🐛 [Report bugs](https://github.com/mainstreamer/isoflags/issues)
- 💡 [Request features](https://github.com/mainstreamer/isoflags/issues)
- 📧 Email: mainstreamer@outlook.com

---

Made with ❤️ by [Rteeom](https://github.com/mainstreamer)
