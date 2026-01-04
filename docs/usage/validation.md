# Validation

Learn how to validate country codes before generating flags.

## CountryCodeValidator

The `CountryCodeValidator` class provides methods to check if a country code is valid.

### Basic Validation

```php
use Rteeom\FlagsGenerator\CountryCodeValidator;

// Validate ISO codes
$isValid = CountryCodeValidator::isValidCountryCode('gb'); // true
$isValid = CountryCodeValidator::isValidCountryCode('us'); // true
$isValid = CountryCodeValidator::isValidCountryCode('invalid'); // false
$isValid = CountryCodeValidator::isValidCountryCode('xyz'); // false
```

### Validate Extended Codes

```php
use Rteeom\FlagsGenerator\CountryCodeValidator;
use Rteeom\FlagsGenerator\Enums\CodeSet;

// Kosovo is NOT in ISO 3166-1
$isValid = CountryCodeValidator::isValidCountryCode('xk', CodeSet::ISO3166);
// false

// Kosovo IS in extended set
$isValid = CountryCodeValidator::isValidCountryCode('xk', CodeSet::EXTENDED);
// true
```

## Practical Example

Validate user input before processing:

```php
use Rteeom\FlagsGenerator\CountryCodeValidator;
use Rteeom\FlagsGenerator\FlagsGenerator;

$userInput = $_POST['country'] ?? '';

if (CountryCodeValidator::isValidCountryCode($userInput)) {
    $flag = FlagsGenerator::getFlag($userInput);
    echo "Your flag: $flag";
} else {
    echo "Invalid country code. Please try again.";
}
```

## Validation vs getFlagOrNull()

There are two approaches to handle potentially invalid codes:

### Approach 1: Validate First

```php
use Rteeom\FlagsGenerator\CountryCodeValidator;
use Rteeom\FlagsGenerator\FlagsGenerator;

if (CountryCodeValidator::isValidCountryCode($code)) {
    $flag = FlagsGenerator::getFlag($code);
    // Do something with $flag
}
```

**Pros:** Explicit validation, clear intent
**Cons:** Two method calls

### Approach 2: Use getFlagOrNull()

```php
use Rteeom\FlagsGenerator\FlagsGenerator;

$flag = FlagsGenerator::getFlagOrNull($code);

if ($flag !== null) {
    // Do something with $flag
}
```

**Pros:** Single method call, simpler
**Cons:** Less explicit

!!! tip "Recommendation"
    Use `getFlagOrNull()` for most cases. Use validation when you need to check validity without generating the flag.

## Case Sensitivity

Validation is case-insensitive:

```php
use Rteeom\FlagsGenerator\CountryCodeValidator;

// All return true
CountryCodeValidator::isValidCountryCode('GB');
CountryCodeValidator::isValidCountryCode('gb');
CountryCodeValidator::isValidCountryCode('Gb');
```

## Getting All Valid Codes

To get a list of all valid codes for validation purposes:

```php
use Rteeom\FlagsGenerator\FlagsGenerator;
use Rteeom\FlagsGenerator\Enums\CodeSet;

// All ISO 3166-1 codes
$isoCodes = FlagsGenerator::getAvailableCodes(CodeSet::ISO3166);

// All codes including extended
$allCodes = FlagsGenerator::getAvailableCodes(CodeSet::EXTENDED);

// Check if user input is in the list
$userInput = 'gb';
if (in_array(strtolower($userInput), $isoCodes)) {
    echo "Valid code!";
}
```

## API Method

### isValidCountryCode()

```php
public static function isValidCountryCode(
    string $isoCountryCode,
    CodeSet $codeSet = CodeSet::ISO3166
): bool
```

**Parameters:**
- `$isoCountryCode` - The country code to validate
- `$codeSet` - Which code set to use (default: `CodeSet::ISO3166`)

**Returns:** `true` if valid, `false` otherwise

## Next Steps

- [Exception Handling](exceptions.md) - Handle invalid codes with exceptions
- [Extended Codes](extended-codes.md) - Learn about extended regional codes
- [API Reference](../api-reference.md) - Complete API documentation
