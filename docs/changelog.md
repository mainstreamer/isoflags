# Changelog

All notable changes to IsoFlags are documented here.

For the complete, detailed changelog, see [CHANGELOG.md on GitHub](https://github.com/mainstreamer/isoflags/blob/master/CHANGELOG.md).

## Latest Release

### [1.3.1] - 2026-01-04

**Highlights:**

- 🎉 **Zero dependencies** - Removed ext-mbstring requirement
- 🚀 Native UTF-8 encoding using PHP's `pack()` function
- 📚 100% code coverage (257 tests, 1018 assertions)
- 🛠️ Complete code quality tooling (Psalm, PHP CS Fixer, PHPCS)

**Breaking Changes:** None

**New Features:**
- Native UTF-8 encoding implementation
- Comprehensive documentation
- CI/CD pipeline with GitHub Actions
- Codecov integration

**Improvements:**
- Replaced `mb_convert_encoding()` with native implementation
- Updated documentation to reflect zero-dependency status

## Previous Releases

### [1.3.0] - 2026-01-04

- Added `getAvailableCodes()` method
- Extended regional codes support (Kosovo, Ascension Island, etc.)
- Migrated to PHP 8.4 with enum-based validation
- Deprecated instance methods in favor of static methods

### [1.2.0]

- Added `CountryCodeValidator` class
- Exception handling with `FlagsGeneratorException`

### [1.1.0]

- Added `getEmojiFlagOrNull()` method
- Comprehensive test suite

### [1.0.0]

- Initial release
- Basic emoji flag generation

## View Full Changelog

[https://github.com/mainstreamer/isoflags/blob/master/CHANGELOG.md](https://github.com/mainstreamer/isoflags/blob/master/CHANGELOG.md)
