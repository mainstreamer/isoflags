# Installation

## Requirements

- **PHP 8.4** or higher
- **No extensions required** - zero dependencies!

## Install via Composer

The easiest way to install IsoFlags is via [Composer](https://getcomposer.org/):

```bash
composer require rteeom/isoflags
```

## Verify Installation

After installation, verify it's working:

```php
<?php

require 'vendor/autoload.php';

use Rteeom\FlagsGenerator\FlagsGenerator;

echo FlagsGenerator::getFlag('gb'); // 🇬🇧
```

If you see the UK flag emoji (🇬🇧), you're all set!

## Alternative: Manual Installation

If you're not using Composer, you can manually download and include the library:

1. Download the [latest release](https://github.com/mainstreamer/isoflags/releases)
2. Extract to your project
3. Include the autoloader:

```php
<?php

require_once 'path/to/isoflags/src/FlagsGenerator.php';
// ... include other files as needed
```

!!! warning "Composer Recommended"
    Manual installation is not recommended. Composer handles autoloading and dependencies automatically.

## Next Steps

Now that you've installed IsoFlags, check out the [Quick Start Guide](quick-start.md) to learn how to use it.
