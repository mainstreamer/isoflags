# Setting Up Code Coverage Locally (Optional)

Code coverage is **automatically generated in GitHub Actions** - you don't need to set it up locally unless you want to see coverage while developing.

## For Fedora/RHEL Users

### Option 1: Install PCOV (Recommended - Faster)

```bash
# Install PCOV extension
sudo dnf install php-pecl-pcov

# Verify installation
php -m | grep pcov

# Test coverage
make coverage-text
```

### Option 2: Install Xdebug (Alternative)

```bash
# Install Xdebug
sudo dnf install php-pecl-xdebug

# Verify installation
php -m | grep xdebug

# Test coverage
make coverage-text
```

## For Ubuntu/Debian Users

### Install PCOV

```bash
sudo apt-get update
sudo apt-get install php-pcov

# Or via PECL
sudo pecl install pcov
```

### Install Xdebug

```bash
sudo apt-get install php-xdebug
```

## For macOS Users

```bash
# Using PECL
pecl install pcov

# Or Xdebug
pecl install xdebug
```

## Verify Installation

```bash
# Check if PCOV is loaded
php -m | grep pcov

# Or check for Xdebug
php -m | grep xdebug

# Show PHP configuration
php --ini
```

## Running Coverage Locally

Once installed, you can use:

```bash
# Text output in terminal
make coverage-text

# HTML report (opens in browser)
make coverage

# Using composer
composer test:coverage

# Direct PHPUnit
./vendor/bin/phpunit --coverage-text
./vendor/bin/phpunit --coverage-html coverage/html
```

## Troubleshooting

### PCOV Not Loading

Check if it's enabled in `php.ini`:

```bash
# Find php.ini location
php --ini

# Check if PCOV is configured
php -i | grep pcov

# Enable PCOV (if installed but not loaded)
echo "extension=pcov.so" | sudo tee -a /etc/php.d/50-pcov.ini

# Or for Ubuntu/Debian
echo "extension=pcov.so" | sudo tee -a /etc/php/8.4/cli/conf.d/20-pcov.ini
```

### Xdebug Slowing Down Tests

If using Xdebug, disable it when not needed:

```bash
# Disable Xdebug temporarily
XDEBUG_MODE=off ./vendor/bin/phpunit

# Or remove the extension config
sudo mv /etc/php.d/15-xdebug.ini /etc/php.d/15-xdebug.ini.disabled
```

### Fedora Specific: Package Not Found

```bash
# Enable EPEL repository (if needed)
sudo dnf install epel-release

# Update package list
sudo dnf update

# Search for PCOV package
sudo dnf search pcov

# Try alternative package name
sudo dnf install php8.4-pecl-pcov
```

## Do I Need This?

**No!** Local coverage is completely optional:

✅ **Coverage works in CI** - GitHub Actions automatically runs coverage with PCOV
✅ **Badge updates automatically** - Codecov badge shows coverage from CI
✅ **PRs show coverage** - Codecov comments on PRs with coverage changes

**When you might want local coverage:**
- 🔍 You want immediate feedback while coding
- 🎯 You're working on improving test coverage
- 🐛 You're debugging which code paths are tested

**When you don't need it:**
- ✨ Just writing code and tests
- 🚀 Relying on CI for coverage checks
- ⚡ Want faster test runs (coverage adds overhead)

## Performance Impact

**PCOV (Recommended):**
- ✅ Minimal performance impact
- ✅ Designed specifically for code coverage
- ✅ Faster than Xdebug

**Xdebug:**
- ⚠️ Significant performance impact (2-3x slower)
- ⚠️ Designed for debugging (coverage is extra feature)
- ✅ More features (debugging, profiling)

## Alternative: Use Docker

Run tests with coverage in Docker (no local install needed):

```bash
# Using PHP 8.4 with PCOV
docker run --rm -v $(pwd):/app -w /app php:8.4-cli-alpine sh -c "
  apk add --no-cache \$PHPIZE_DEPS libzip-dev git && \
  pecl install pcov && \
  docker-php-ext-enable pcov && \
  curl -sS https://getcomposer.org/installer | php && \
  php composer.phar install && \
  vendor/bin/phpunit --coverage-text
"
```

## Summary

| Method | Setup Required | Speed | Recommended For |
|--------|---------------|-------|-----------------|
| **GitHub Actions** | ✅ Already configured | Fast (parallel) | Everyone |
| **Local PCOV** | Install extension | Fast | Active development |
| **Local Xdebug** | Install extension | Slower | Debugging needed |
| **Docker** | Docker installed | Medium | No system changes |
| **No coverage** | None | Fastest | Quick testing |

**Recommendation:** Skip local coverage unless you specifically need it. The CI handles everything automatically!
