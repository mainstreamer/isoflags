# Extended Regional Codes

In addition to all standard ISO 3166-1 alpha-2 country codes, IsoFlags supports extended regional codes.

## What are Extended Codes?

Extended codes are unofficial or reserved ISO codes for regions that aren't sovereign nations but have their own flag emojis:

- Kosovo (XK) - Not officially in ISO 3166-1
- Ascension Island (AC) - Reserved code
- And more!

## Supported Extended Codes

| Code | Region | Flag |
|------|--------|------|
| `ac` | Ascension Island | 🇦🇨 |
| `dg` | Diego Garcia | 🇩🇬 |
| `ea` | Ceuta & Melilla | 🇪🇦 |
| `ic` | Canary Islands | 🇮🇨 |
| `ta` | Tristan da Cunha | 🇹🇦 |
| `xk` | Kosovo | 🇽🇰 |

## Usage

To use extended codes, specify `CodeSet::EXTENDED`:

```php
use Rteeom\FlagsGenerator\FlagsGenerator;
use Rteeom\FlagsGenerator\Enums\CodeSet;

// This will throw an exception (XK not in ISO 3166-1)
try {
    FlagsGenerator::getFlag('xk', CodeSet::ISO3166);
} catch (FlagsGeneratorException $e) {
    echo "Invalid code!";
}

// This works! (XK is in extended set)
echo FlagsGenerator::getFlag('xk', CodeSet::EXTENDED); // 🇽🇰
```

## Examples

### Kosovo

```php
use Rteeom\FlagsGenerator\FlagsGenerator;
use Rteeom\FlagsGenerator\Enums\CodeSet;

$flag = FlagsGenerator::getFlag('xk', CodeSet::EXTENDED);
echo $flag; // 🇽🇰
```

### Ascension Island

```php
use Rteeom\FlagsGenerator\FlagsGenerator;
use Rteeom\FlagsGenerator\Enums\CodeSet;

$flag = FlagsGenerator::getFlag('ac', CodeSet::EXTENDED);
echo $flag; // 🇦🇨
```

### All Extended Codes

```php
use Rteeom\FlagsGenerator\FlagsGenerator;
use Rteeom\FlagsGenerator\Enums\CodeSet;

$extendedCodes = ['ac', 'dg', 'ea', 'ic', 'ta', 'xk'];

foreach ($extendedCodes as $code) {
    $flag = FlagsGenerator::getFlag($code, CodeSet::EXTENDED);
    echo "$flag " . strtoupper($code) . "\n";
}

// Output:
// 🇦🇨 AC
// 🇩🇬 DG
// 🇪🇦 EA
// 🇮🇨 IC
// 🇹🇦 TA
// 🇽🇰 XK
```

## Get All Available Codes

Including extended codes:

```php
use Rteeom\FlagsGenerator\FlagsGenerator;
use Rteeom\FlagsGenerator\Enums\CodeSet;

// Get all codes (ISO + extended)
$allCodes = FlagsGenerator::getAvailableCodes(CodeSet::EXTENDED);

// Filter only extended codes
$isoCodes = FlagsGenerator::getAvailableCodes(CodeSet::ISO3166);
$extendedOnly = array_diff($allCodes, $isoCodes);

print_r($extendedOnly);
// Array: ['ac', 'dg', 'ea', 'ic', 'ta', 'xk']
```

## Default Behavior

By default, methods use `CodeSet::ISO3166` (standard codes only):

```php
use Rteeom\FlagsGenerator\FlagsGenerator;

// These are equivalent
FlagsGenerator::getFlag('gb');
FlagsGenerator::getFlag('gb', CodeSet::ISO3166);

// Extended codes require explicit specification
FlagsGenerator::getFlag('xk', CodeSet::EXTENDED);
```

## Validation

To validate extended codes, use the `CountryCodeValidator` with `CodeSet::EXTENDED`:

```php
use Rteeom\FlagsGenerator\CountryCodeValidator;
use Rteeom\FlagsGenerator\Enums\CodeSet;

// Validate with ISO codes
$isValid = CountryCodeValidator::isValidCountryCode('xk', CodeSet::ISO3166);
// false (Kosovo not in ISO 3166-1)

// Validate with extended codes
$isValid = CountryCodeValidator::isValidCountryCode('xk', CodeSet::EXTENDED);
// true (Kosovo in extended set)
```

Learn more in the [Validation](validation.md) section.

## Next Steps

- [Validation](validation.md) - Validate country codes
- [Exception Handling](exceptions.md) - Handle errors gracefully
- [API Reference](../api-reference.md) - Complete API documentation
