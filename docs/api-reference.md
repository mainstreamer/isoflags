# API Reference

Complete API documentation for IsoFlags.

## FlagsGenerator

Main class for generating emoji flags from country codes.

### Static Methods

#### getFlag()

Generate an emoji flag from a country code. Throws exception on invalid code.

```php
public static function getFlag(
    string $isoCode,
    CodeSet $codeSet = CodeSet::ISO3166
): string
```

**Parameters:**

- `$isoCode` (string) - Two-letter country code (case-insensitive)
- `$codeSet` (CodeSet) - Code set to use (default: `CodeSet::ISO3166`)

**Returns:** `string` - Emoji flag

**Throws:** `FlagsGeneratorException` - If country code is invalid

**Example:**
```php
$flag = FlagsGenerator::getFlag('gb'); // 🇬🇧
$flag = FlagsGenerator::getFlag('xk', CodeSet::EXTENDED); // 🇽🇰
```

---

#### getFlagOrNull()

Generate an emoji flag or return null for invalid codes. Safe alternative that doesn't throw exceptions.

```php
public static function getFlagOrNull(
    string $isoCode,
    CodeSet $codeSet = CodeSet::ISO3166
): ?string
```

**Parameters:**

- `$isoCode` (string) - Two-letter country code (case-insensitive)
- `$codeSet` (CodeSet) - Code set to use (default: `CodeSet::ISO3166`)

**Returns:** `?string` - Emoji flag or `null` if invalid

**Example:**
```php
$flag = FlagsGenerator::getFlagOrNull('us'); // 🇺🇸
$flag = FlagsGenerator::getFlagOrNull('invalid'); // null
```

---

#### getAvailableCodes()

Get array of all available country codes for the specified code set.

```php
public static function getAvailableCodes(
    CodeSet $codeSet = CodeSet::ISO3166
): array
```

**Parameters:**

- `$codeSet` (CodeSet) - Code set to use (default: `CodeSet::ISO3166`)

**Returns:** `array<string>` - Array of country code strings

**Example:**
```php
$codes = FlagsGenerator::getAvailableCodes();
// ['ad', 'ae', 'af', ..., 'zw']

$allCodes = FlagsGenerator::getAvailableCodes(CodeSet::EXTENDED);
// [..., 'ac', 'dg', 'ea', 'ic', 'ta', 'xk']
```

---

### Instance Methods (Deprecated)

!!! warning "Deprecated"
    Instance methods will be removed in v2.0. Use static methods instead.

#### getEmojiFlag()

**Deprecated:** Use `FlagsGenerator::getFlag()` instead.

```php
public function getEmojiFlag(
    string $isoCountryCode,
    CodeSet $codeSet = CodeSet::ISO3166
): string
```

#### getEmojiFlagOrNull()

**Deprecated:** Use `FlagsGenerator::getFlagOrNull()` instead.

```php
public function getEmojiFlagOrNull(
    string $isoCode,
    CodeSet $codeSet = CodeSet::ISO3166
): ?string
```

---

## CountryCodeValidator

Class for validating country codes.

### isValidCountryCode()

Check if a country code is valid for the specified code set.

```php
public static function isValidCountryCode(
    string $isoCountryCode,
    CodeSet $codeSet = CodeSet::ISO3166
): bool
```

**Parameters:**

- `$isoCountryCode` (string) - Two-letter country code (case-insensitive)
- `$codeSet` (CodeSet) - Code set to use (default: `CodeSet::ISO3166`)

**Returns:** `bool` - `true` if valid, `false` otherwise

**Example:**
```php
$valid = CountryCodeValidator::isValidCountryCode('gb'); // true
$valid = CountryCodeValidator::isValidCountryCode('invalid'); // false
$valid = CountryCodeValidator::isValidCountryCode('xk', CodeSet::EXTENDED); // true
```

---

## Enums

### CodeSet

Enum defining which set of country codes to use.

```php
enum CodeSet: string
{
    case ISO3166 = 'iso3166';
    case EXTENDED = 'extended';
}
```

**Values:**

- `CodeSet::ISO3166` - Standard ISO 3166-1 alpha-2 codes only (249 codes)
- `CodeSet::EXTENDED` - ISO codes plus extended regional codes (255 codes)

**Example:**
```php
use Rteeom\FlagsGenerator\Enums\CodeSet;

$flag = FlagsGenerator::getFlag('gb', CodeSet::ISO3166);
$flag = FlagsGenerator::getFlag('xk', CodeSet::EXTENDED);
```

---

### IsoCode

Enum containing all standard ISO 3166-1 alpha-2 country codes.

```php
enum IsoCode: string
{
    case AD = 'ad'; // Andorra
    case AE = 'ae'; // United Arab Emirates
    // ... (249 total codes)
    case ZW = 'zw'; // Zimbabwe
}
```

**Usage:** Internal enum used for validation. Access all codes via `FlagsGenerator::getAvailableCodes()`.

---

### ExtendedCode

Enum containing extended regional codes in addition to ISO codes.

```php
enum ExtendedCode: string
{
    // All ISO codes +
    case AC = 'ac'; // Ascension Island
    case DG = 'dg'; // Diego Garcia
    case EA = 'ea'; // Ceuta & Melilla
    case IC = 'ic'; // Canary Islands
    case TA = 'ta'; // Tristan da Cunha
    case XK = 'xk'; // Kosovo
}
```

**Usage:** Internal enum used for validation. Access all codes via `FlagsGenerator::getAvailableCodes(CodeSet::EXTENDED)`.

---

## Exceptions

### FlagsGeneratorException

Exception thrown when an invalid country code is provided to `getFlag()`.

```php
class FlagsGeneratorException extends \Exception
{
    public function __construct(string $countryCode);
}
```

**Constructor:**

- `$countryCode` (string) - The invalid country code

**Message format:** `"Invalid country code given {code}"`

**Example:**
```php
use Rteeom\FlagsGenerator\Exceptions\FlagsGeneratorException;

try {
    $flag = FlagsGenerator::getFlag('invalid');
} catch (FlagsGeneratorException $e) {
    echo $e->getMessage(); // "Invalid country code given invalid"
}
```

---

## Type Definitions

All code is fully typed with PHP 8.4 strict types:

```php
declare(strict_types=1);
```

**String types:** All country codes are `string` type
**Nullable returns:** Methods that can return null are typed `?string`
**Arrays:** Code lists are typed `array<string>`
**Enums:** CodeSet, IsoCode, and ExtendedCode are backed enums

---

## Complete Usage Example

```php
<?php

declare(strict_types=1);

use Rteeom\FlagsGenerator\FlagsGenerator;
use Rteeom\FlagsGenerator\CountryCodeValidator;
use Rteeom\FlagsGenerator\Enums\CodeSet;
use Rteeom\FlagsGenerator\Exceptions\FlagsGeneratorException;

// Basic flag generation
$flag = FlagsGenerator::getFlag('gb'); // 🇬🇧

// Safe flag generation
$flag = FlagsGenerator::getFlagOrNull('us') ?? '🏳️';

// Validation
if (CountryCodeValidator::isValidCountryCode('fr')) {
    $flag = FlagsGenerator::getFlag('fr');
}

// Extended codes
$kosovoFlag = FlagsGenerator::getFlag('xk', CodeSet::EXTENDED);

// Exception handling
try {
    $flag = FlagsGenerator::getFlag($userInput);
} catch (FlagsGeneratorException $e) {
    error_log($e->getMessage());
}

// Get all codes
$allCodes = FlagsGenerator::getAvailableCodes(CodeSet::EXTENDED);
```
