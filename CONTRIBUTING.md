# Contributing to IsoFlags

Thank you for considering contributing to IsoFlags! This document provides guidelines and instructions for contributing.

## Development Setup

### Prerequisites

- PHP 8.4 or higher
- Composer
- Git
- PCOV or Xdebug (for code coverage)

### Getting Started

1. Fork the repository on GitHub
2. Clone your fork locally:
   ```bash
   git clone https://github.com/YOUR-USERNAME/isoflags.git
   cd isoflags
   ```

3. Install dependencies:
   ```bash
   composer install
   ```

4. Create a new branch for your feature or fix:
   ```bash
   git checkout -b feature/your-feature-name
   ```

## Running Tests

### Basic Test Suite

Run the complete test suite:

```bash
./vendor/bin/phpunit
```

### With Code Coverage

First, install a coverage driver:

```bash
# PCOV (recommended - faster)
pecl install pcov

# OR Xdebug
pecl install xdebug
```

Generate coverage reports:

```bash
# HTML report (viewable in browser)
./vendor/bin/phpunit --coverage-html coverage/html
open coverage/html/index.html

# Terminal output
./vendor/bin/phpunit --coverage-text

# XML for CI/CD
./vendor/bin/phpunit --coverage-clover coverage.xml
```

### Running Specific Tests

```bash
# Run a specific test file
./vendor/bin/phpunit tests/FlagsGeneratorTest.php

# Run a specific test method
./vendor/bin/phpunit --filter testMethodName
```

## Code Quality Standards

### Coding Standards

- Follow PSR-12 coding standards
- Use strict types: `declare(strict_types=1);` at the top of all PHP files
- Use type hints for all parameters and return types
- Write clear, self-documenting code

### Testing Standards

- All new features must include tests
- Bug fixes should include regression tests
- Aim for 100% code coverage on new code
- Tests should be clear and descriptive

### Example Test Structure

```php
public function test_descriptive_name_of_what_is_being_tested(): void
{
    // Arrange - set up test data
    $input = 'gb';

    // Act - execute the code being tested
    $result = FlagsGenerator::getFlag($input);

    // Assert - verify the results
    $this->assertNotNull($result);
    $this->assertSame('🇬🇧', $result);
}
```

## Continuous Integration

All pull requests are automatically tested via GitHub Actions:

- **Tests**: Full test suite runs on PHP 8.4
- **Code Coverage**: Coverage reports are generated and uploaded to Codecov
- **Code Quality**: Static analysis checks

Make sure your code passes all CI checks before requesting review.

## Pull Request Process

1. **Update Tests**: Add or update tests for your changes
2. **Run Tests Locally**: Ensure all tests pass
3. **Update Documentation**: Update README.md if you're adding features
4. **Update CHANGELOG**: Add your changes to the `[Unreleased]` section
5. **Commit Messages**: Write clear, descriptive commit messages
6. **Push Changes**: Push to your fork
7. **Create PR**: Open a pull request with a clear description

### Commit Message Guidelines

Use conventional commit format:

```
type(scope): brief description

Detailed explanation (optional)

Fixes #123
```

**Types:**
- `feat`: New feature
- `fix`: Bug fix
- `docs`: Documentation changes
- `test`: Test updates
- `refactor`: Code refactoring
- `perf`: Performance improvements
- `chore`: Maintenance tasks

**Examples:**
```
feat(validator): add support for custom validation rules
fix(generator): handle empty string input correctly
docs(readme): add code coverage instructions
test(generator): add edge case tests for null values
```

## Adding New ISO Codes

To add new country codes:

1. Add the code to the appropriate enum:
   - `src/Enums/IsoCode.php` for standard ISO 3166-1 codes
   - `src/Enums/ExtendedCode.php` for extended/regional codes

2. Add test data to the appropriate JSON file in `tests/resources/`:
   - `africa.json`, `americas.json`, `asia.json`, `europe.json`, `oceania.json` for ISO codes
   - `africa_extended.json`, `asia_extended.json`, `europe_extended.json` for extended codes

3. Run tests to verify:
   ```bash
   ./vendor/bin/phpunit
   ```

## Reporting Issues

When reporting issues, please include:

- PHP version
- Steps to reproduce
- Expected behavior
- Actual behavior
- Error messages (if any)

## Feature Requests

Feature requests are welcome! Please:

1. Check if the feature already exists
2. Search existing issues to avoid duplicates
3. Clearly describe the use case
4. Explain why the feature would be valuable

## Code Review

All submissions require review. We use GitHub pull requests for this purpose. Reviewers will check:

- Code quality and style
- Test coverage
- Documentation
- Performance implications
- Backward compatibility

## Getting Help

- Open an issue for bugs or questions
- Check existing issues and documentation first
- Be respectful and constructive

## License

By contributing, you agree that your contributions will be licensed under the MIT License.

## Recognition

Contributors will be recognized in release notes and the project README (if desired).

Thank you for contributing to IsoFlags!
