# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.1.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [Unreleased]

## [1.3.1] - 2026-01-04

### Added
- Comprehensive README.md with full API documentation and usage examples
- MIT License file
- CHANGELOG.md to track version history
- CONTRIBUTING.md with detailed contribution guidelines
- GitHub Actions workflow (CI Pipeline) for automated testing and code coverage
- Code coverage configuration in PHPUnit with PCOV support
- Codecov integration with `codecov.yml` configuration
- Coverage badges in README (Codecov integration)
- CI/CD badges in README (GitHub Actions, PHP version)
- Code quality tools integration:
  - Psalm (static analysis) with level 7
  - PHP CS Fixer (code style)
  - PHPCS (PSR-12 compliance)
- Makefile with shortcuts for all development tasks
- Composer scripts for QA tasks (`test`, `psalm`, `cs:fix`, `cs:check`, `phpcs`, `qa`)
- Local coverage setup documentation (`.github/LOCAL_COVERAGE_SETUP.md`)
- Codecov troubleshooting guide (`.github/CODECOV_TROUBLESHOOTING.md`)
- Tests for deprecated methods and exception paths
- 100% code coverage achievement (257 tests, 1018 assertions)
- HTML, Clover XML, and text coverage report generation
- Coverage and cache directories added to .gitignore

### Fixed
- Added missing `declare(strict_types=1)` to all source files for consistency
- Removed trailing comma syntax error in FlagsGeneratorException constructor
- Code style fixes applied by PHP CS Fixer (PSR-12 compliance)
- Test file namespace added for PSR-4 compliance
- PCOV automatic enabling in Makefile and composer scripts

### Changed
- Updated phpunit.xml.dist to generate coverage reports in multiple formats
- GitHub Actions workflow renamed from "Tests" to "CI Pipeline"
- Enhanced error messages in Makefile for missing coverage drivers

## [1.3.0] - 2026-01-04

### Added
- `getAvailableCodes()` static method to retrieve all available ISO codes
- Support for CodeSet parameter to distinguish between ISO3166 and EXTENDED codes
- Extended regional codes support:
  - AC (Ascension Island)
  - DG (Diego Garcia)
  - EA (Ceuta & Melilla)
  - IC (Canary Islands)
  - TA (Tristan da Cunha)
  - XK (Kosovo)

### Changed
- Refactored codebase for PHP 8.4 compatibility
- Migrated validation logic to use enum-based approach (IsoCode and ExtendedCode enums)
- Replaced regex-based validation with type-safe enum validation
- Deprecated instance methods in favor of static methods:
  - `getEmojiFlag()` → use `getFlag()` instead
  - `getEmojiFlagOrNull()` → use `getFlagOrNull()` instead
  - `isValid()` in CountryCodeValidator → use `isValidCountryCode()` instead

### Fixed
- Fixed Kosovo (XK) country code support
- Fixed Curaçao (CW) country code support

### Removed
- Legacy regex-based validation patterns

## [1.2.0] - Previous Release

### Added
- CountryCodeValidator class for validation
- Exception handling with IsoFlagGeneratorException (later renamed to FlagsGeneratorException)

### Changed
- Improved code organization with namespace structure

## [1.1.0] - Previous Release

### Added
- Support for null return on invalid codes with `getEmojiFlagOrNull()`
- Comprehensive test suite with PHPUnit

## [1.0.0] - Initial Release

### Added
- Basic emoji flag generation from ISO 3166-1 alpha-2 country codes
- `getEmojiFlag()` method
- Support for all standard ISO country codes
- PHPUnit test coverage

---

## Deprecation Notice

The following methods are deprecated and will be removed in version 2.0.0:

- `FlagsGenerator::getEmojiFlag()` - Use `FlagsGenerator::getFlag()` instead
- `FlagsGenerator::getEmojiFlagOrNull()` - Use `FlagsGenerator::getFlagOrNull()` instead
- `CountryCodeValidator::isValid()` - Use `CountryCodeValidator::isValidCountryCode()` instead

## Migration Guide

### Upgrading from 1.2.x to 1.3.0

**Before:**
```php
$generator = new FlagsGenerator();
$flag = $generator->getEmojiFlag('gb');
```

**After (recommended):**
```php
use Rteeom\FlagsGenerator\FlagsGenerator;

$flag = FlagsGenerator::getFlag('gb');
```

### PHP Version Requirements

- v1.3.0+: Requires PHP 8.4 or higher
- v1.2.x and below: Check individual release notes

[Unreleased]: https://github.com/mainstreamer/isoflags/compare/v1.3.0...HEAD
[1.3.0]: https://github.com/mainstreamer/isoflags/releases/tag/v1.3.0
[1.2.0]: https://github.com/mainstreamer/isoflags/releases/tag/v1.2.0
[1.1.0]: https://github.com/mainstreamer/isoflags/releases/tag/v1.1.0
[1.0.0]: https://github.com/mainstreamer/isoflags/releases/tag/v1.0.0
