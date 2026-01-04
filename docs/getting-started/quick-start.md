# Quick Start

Get started with IsoFlags in under 2 minutes!

## Basic Usage

The simplest way to use IsoFlags is with the static `getFlag()` method:

```php
<?php

use Rteeom\FlagsGenerator\FlagsGenerator;

// Generate flag emojis
echo FlagsGenerator::getFlag('gb'); // 🇬🇧
echo FlagsGenerator::getFlag('ua'); // 🇺🇦
echo FlagsGenerator::getFlag('jp'); // 🇯🇵
echo FlagsGenerator::getFlag('br'); // 🇧🇷
```

## Safe Usage (No Exceptions)

Use `getFlagOrNull()` when you're not sure if the code is valid:

```php
<?php

use Rteeom\FlagsGenerator\FlagsGenerator;

$flag = FlagsGenerator::getFlagOrNull('us'); // 🇺🇸
$invalid = FlagsGenerator::getFlagOrNull('invalid'); // null

if ($flag !== null) {
    echo "Flag: $flag";
}
```

## Real-World Example

Here's a practical example - displaying user countries:

```php
<?php

use Rteeom\FlagsGenerator\FlagsGenerator;

$users = [
    ['name' => 'John', 'country' => 'gb'],
    ['name' => 'Olena', 'country' => 'ua'],
    ['name' => 'Yuki', 'country' => 'jp'],
];

foreach ($users as $user) {
    $flag = FlagsGenerator::getFlag($user['country']);
    echo "{$flag} {$user['name']} \n";
}

// Output:
// 🇬🇧 John
// 🇺🇦 Olena
// 🇯🇵 Yuki
```

## Case Insensitive

Country codes are case-insensitive:

```php
<?php

use Rteeom\FlagsGenerator\FlagsGenerator;

echo FlagsGenerator::getFlag('GB'); // 🇬🇧
echo FlagsGenerator::getFlag('gb'); // 🇬🇧
echo FlagsGenerator::getFlag('Gb'); // 🇬🇧
// All produce the same result!
```

## What's Next?

- Learn more about [Basic Usage](../usage/basic-usage.md)
- Explore [Extended Regional Codes](../usage/extended-codes.md)
- Check the [API Reference](../api-reference.md)
