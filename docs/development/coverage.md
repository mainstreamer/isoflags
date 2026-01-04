# Code Coverage

IsoFlags maintains **100% code coverage** across all classes and methods.

## Current Coverage

- **Classes:** 100% (3/3)
- **Methods:** 100% (9/9)
- **Lines:** 100% (23/23)
- **Total Tests:** 257
- **Total Assertions:** 1018

## Covered Components

### FlagsGenerator
- ✅ All static methods (`getFlag`, `getFlagOrNull`, `getAvailableCodes`)
- ✅ All instance methods (deprecated)
- ✅ UTF-8 encoding logic

### CountryCodeValidator
- ✅ Validation for all country codes
- ✅ Both ISO3166 and EXTENDED code sets

### FlagsGeneratorException
- ✅ Exception construction and messaging

## Viewing Coverage

### Online (Codecov)

View interactive coverage reports on Codecov:

[https://codecov.io/gh/mainstreamer/isoflags](https://codecov.io/gh/mainstreamer/isoflags)

Features:
- Line-by-line coverage visualization
- Coverage trends over time
- PR coverage diffs

### Local HTML Report

Generate and view coverage locally:

```bash
make coverage
```

Then open `coverage/html/index.html` in your browser.

### Local Text Report

Quick coverage summary in terminal:

```bash
make coverage-text
```

## Coverage Requirements

### For Pull Requests

- Coverage must remain at **100%**
- All new code must be tested
- No untested lines allowed

### Setup Local Coverage

Install PCOV for fast coverage generation:

```bash
# Fedora/RHEL
sudo dnf install php-pecl-pcov

# Ubuntu/Debian
sudo apt-get install php-pcov

# macOS
pecl install pcov
```

See [LOCAL_COVERAGE_SETUP.md](https://github.com/mainstreamer/isoflags/blob/master/.github/LOCAL_COVERAGE_SETUP.md) for detailed instructions.

## GitHub Actions

Coverage is automatically:
- Generated on every push
- Uploaded to Codecov
- Reported in PR comments

No local setup required for CI coverage.

## Coverage Details

### What's Tested

**All country codes** from JSON fixtures:
- Africa (57 codes)
- Americas (57 codes)
- Asia (54 codes)
- Europe (59 codes)
- Oceania (27 codes)
- Extended (6 codes)

**All methods:**
- Static flag generation
- Instance methods (deprecated)
- Validation
- Code set handling
- Exception throwing
- Null returns

**All edge cases:**
- Invalid codes
- Case insensitivity
- Extended vs ISO codes
- Empty strings
- Special characters

### Coverage Reports

Multiple formats generated:

```bash
# HTML (visual)
coverage/html/index.html

# Clover XML (tools)
coverage.xml

# Text (terminal)
make coverage-text
```

## Maintaining Coverage

When adding new code:

1. **Write tests first** (TDD approach)
2. **Run coverage check:**
   ```bash
   make coverage-text
   ```
3. **Ensure 100% coverage** before committing
4. **Check CI** - GitHub Actions will verify

!!! warning "Coverage Gate"
    PRs with less than 100% coverage will not be merged.

## Why 100% Coverage?

Benefits:
- ✅ Confidence in code quality
- ✅ Catch regressions early
- ✅ Safe refactoring
- ✅ Documentation via tests
- ✅ Professional standard

Small library = achievable and maintainable 100% coverage.

## Next Steps

- [Running Tests](testing.md) - Learn how to run tests
- [Contributing](contributing.md) - Contribution guidelines
