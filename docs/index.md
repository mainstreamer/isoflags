# IsoFlags

[![License](https://poser.pugx.org/rteeom/isoflags/license)](https://packagist.org/packages/rteeom/isoflags)
[![Latest Stable Version](https://poser.pugx.org/rteeom/isoflags/v/stable)](https://packagist.org/packages/rteeom/isoflags)
[![Total Downloads](https://poser.pugx.org/rteeom/isoflags/downloads)](https://packagist.org/packages/rteeom/isoflags)
[![Tests](https://github.com/mainstreamer/isoflags/actions/workflows/tests.yml/badge.svg)](https://github.com/mainstreamer/isoflags/actions/workflows/tests.yml)
[![codecov](https://codecov.io/gh/mainstreamer/isoflags/branch/master/graph/badge.svg)](https://codecov.io/gh/mainstreamer/isoflags)
[![PHP Version](https://img.shields.io/badge/php-%3E%3D8.4-8892BF.svg)](https://php.net/)

A modern PHP library for generating emoji flags from ISO 3166-1 alpha-2 country codes and extended regional codes.

## Features

:material-flag: **Generate emoji flags** from ISO 3166-1 alpha-2 country codes
:material-earth: **Extended regional codes** support (Kosovo, Ascension Island, etc.)
:material-shield-check: **Type-safe** with PHP 8.4 enums
:material-lightning-bolt: **Static and instance methods** available
:material-check-all: **100% test coverage** (257 tests, 1018 assertions)
:material-package-variant-closed: **Zero dependencies** - only requires PHP 8.4+

## Quick Example

```php
use Rteeom\FlagsGenerator\FlagsGenerator;

// Get flag emoji
echo FlagsGenerator::getFlag('gb'); // 🇬🇧
echo FlagsGenerator::getFlag('ua'); // 🇺🇦
echo FlagsGenerator::getFlag('us'); // 🇺🇸

// Safely get flag or null
$flag = FlagsGenerator::getFlagOrNull('invalid'); // null
```

## Installation

Install via Composer:

```bash
composer require rteeom/isoflags
```

**Requirements:** PHP 8.4 or higher

## How It Works

The library converts two-letter country codes to emoji flags by transforming each letter into its corresponding Regional Indicator Symbol:

1. Each letter is converted to its Unicode codepoint (offset by 127365)
2. The codepoint is encoded to UTF-8 bytes using native PHP functions
3. Regional Indicator Symbols (U+1F1E6 to U+1F1FF) combine to form flag emojis

**Example:** `GB` becomes:

- `G` → 🇬 (U+1F1EC = 127468)
- `B` → 🇧 (U+1F1E7 = 127463)
- **Combined:** 🇬🇧

The library uses **no external dependencies** - just native PHP byte packing to generate UTF-8 encoded emoji flags.

## What's Next?

- [Installation Guide](getting-started/installation.md) - Detailed installation instructions
- [Quick Start](getting-started/quick-start.md) - Get started in 2 minutes
- [Basic Usage](usage/basic-usage.md) - Learn the core functionality
- [Extended Codes](usage/extended-codes.md) - Kosovo, Ascension Island, and more
- [API Reference](api-reference.md) - Complete API documentation

## Support

- **GitHub Issues:** [Report bugs or request features](https://github.com/mainstreamer/isoflags/issues)
- **Packagist:** [View on Packagist](https://packagist.org/packages/rteeom/isoflags)
- **Email:** mainstreamer@outlook.com

## License

MIT License - see [LICENSE](https://github.com/mainstreamer/isoflags/blob/master/LICENSE) file for details.
