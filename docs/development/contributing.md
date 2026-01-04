# Contributing

Thank you for considering contributing to IsoFlags! This guide will help you get started.

## Code of Conduct

Be respectful, constructive, and professional in all interactions.

## How to Contribute

### Reporting Bugs

Found a bug? Please [open an issue](https://github.com/mainstreamer/isoflags/issues) with:

- Clear description of the problem
- Steps to reproduce
- Expected vs actual behavior
- PHP version and environment details

### Suggesting Features

Have an idea? [Open an issue](https://github.com/mainstreamer/isoflags/issues) with:

- Clear description of the feature
- Use cases and benefits
- Proposed implementation (optional)

### Pull Requests

1. **Fork the repository**
2. **Create a feature branch**
   ```bash
   git checkout -b feat/my-feature
   ```

3. **Make your changes**
   - Follow existing code style
   - Add tests for new features
   - Update documentation

4. **Run QA checks**
   ```bash
   make qa
   ```

5. **Commit your changes**
   ```bash
   git commit -m "feat: add new feature"
   ```

6. **Push and create PR**
   ```bash
   git push origin feat/my-feature
   ```
   Then open a Pull Request on GitHub

## Development Setup

### Requirements

- PHP 8.4 or higher
- Composer

### Installation

```bash
# Clone your fork
git clone https://github.com/YOUR_USERNAME/isoflags.git
cd isoflags

# Install dependencies
composer install
```

### Running Tests

```bash
# Run all tests
./vendor/bin/phpunit

# Or use make
make test
```

### Code Quality

```bash
# Run all QA checks
make qa

# Individual checks
make test          # PHPUnit tests
make psalm         # Static analysis
make cs-check      # Code style check
make phpcs         # PSR-12 compliance

# Fix code style issues
make cs-fix
```

## Coding Standards

### PHP Standards

- **PSR-12** code style
- **Strict types** - All files must have `declare(strict_types=1)`
- **Type hints** - Use type hints for all parameters and return types
- **Enums** - Use PHP 8.4 enums where appropriate

### Testing

- All new features **must** have tests
- Maintain **100% code coverage**
- Tests must pass before merging

### Documentation

- Update documentation for new features
- Add code examples
- Keep README.md concise (detailed docs go in `docs/`)

## Commit Messages

Follow conventional commits:

```
feat: add new feature
fix: correct typo in README
docs: update API documentation
test: add tests for validation
chore: update dependencies
```

## Release Process

Releases follow the PR-based workflow:

1. Create PR with changes
2. Update CHANGELOG.md in the PR
3. Merge PR to master
4. Trigger GitHub Release workflow
5. Tag and release created automatically

See [RELEASE.md](https://github.com/mainstreamer/isoflags/blob/master/.github/RELEASE.md) for details.

## Questions?

Feel free to ask questions by:

- [Opening an issue](https://github.com/mainstreamer/isoflags/issues)
- Emailing: mainstreamer@outlook.com

Thank you for contributing!
