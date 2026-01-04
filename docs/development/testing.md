# Running Tests

IsoFlags has comprehensive test coverage with 257 tests and 1018 assertions.

## Quick Start

Run all tests:

```bash
./vendor/bin/phpunit
```

Or use the Makefile shortcut:

```bash
make test
```

## Test Coverage

The library maintains **100% code coverage**.

### Generate Coverage Report

**Text Output:**
```bash
make coverage-text
```

**HTML Report:**
```bash
make coverage
```

Then open `coverage/html/index.html` in your browser.

**XML Report:**
```bash
./vendor/bin/phpunit --coverage-clover coverage.xml
```

### Coverage Requirements

To generate coverage locally, you need either:

- **PCOV** (recommended - faster)
- **Xdebug** (slower but more features)

**Install PCOV:**

```bash
# Fedora/RHEL
sudo dnf install php-pecl-pcov

# Ubuntu/Debian
sudo apt-get install php-pcov

# macOS
pecl install pcov
```

!!! note "GitHub Actions"
    Coverage is automatically generated in CI/CD pipeline. Local coverage generation is optional.

## Test Organization

Tests are organized by continent in JSON fixtures:

```
tests/
├── FlagsGeneratorTest.php
└── countries/
    ├── africa.json
    ├── americas.json
    ├── asia.json
    ├── europe.json
    ├── oceania.json
    └── extended.json
```

## Running Specific Tests

### Single Test Class

```bash
./vendor/bin/phpunit tests/FlagsGeneratorTest.php
```

### Single Test Method

```bash
./vendor/bin/phpunit --filter testGetFlag
```

### Test Group

```bash
./vendor/bin/phpunit --group validation
```

## Test Examples

### Testing Flag Generation

```php
public function testGetFlag(): void
{
    $flag = FlagsGenerator::getFlag('gb');
    $this->assertIsString($flag);
    $this->assertEquals('🇬🇧', $flag);
}
```

### Testing Validation

```php
public function testValidation(): void
{
    $this->assertTrue(
        CountryCodeValidator::isValidCountryCode('gb')
    );

    $this->assertFalse(
        CountryCodeValidator::isValidCountryCode('invalid')
    );
}
```

### Testing Exceptions

```php
public function testInvalidCodeThrowsException(): void
{
    $this->expectException(FlagsGeneratorException::class);
    $this->expectExceptionMessage('Invalid country code given invalid');

    FlagsGenerator::getFlag('invalid');
}
```

## Writing New Tests

When adding features, write tests that:

1. **Test happy path** - Normal, expected usage
2. **Test edge cases** - Boundary conditions
3. **Test error cases** - Invalid input handling
4. **Maintain coverage** - Ensure 100% coverage

Example:

```php
public function testNewFeature(): void
{
    // Happy path
    $result = MyClass::newMethod('valid');
    $this->assertEquals('expected', $result);

    // Edge case
    $result = MyClass::newMethod('');
    $this->assertNull($result);

    // Error case
    $this->expectException(MyException::class);
    MyClass::newMethod('invalid');
}
```

## Continuous Integration

Tests run automatically on every push via GitHub Actions:

- PHP 8.4
- All QA checks (tests, Psalm, code style)
- Coverage uploaded to Codecov

See `.github/workflows/tests.yml` for CI configuration.

## Quality Assurance

Run all QA checks before committing:

```bash
make qa
```

This runs:
- PHPUnit tests
- Psalm static analysis
- PHP CS Fixer code style check
- PHPCS PSR-12 compliance

All checks must pass before merging PRs.

## Next Steps

- [Code Coverage](coverage.md) - Detailed coverage information
- [Contributing](contributing.md) - Contribution guidelines
