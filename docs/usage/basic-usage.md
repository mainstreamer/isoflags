# Basic Usage

## Static Methods (Recommended)

The recommended way to use IsoFlags is through static methods:

### getFlag()

Returns an emoji flag for a valid country code, or throws an exception for invalid codes.

```php
use Rteeom\FlagsGenerator\FlagsGenerator;

echo FlagsGenerator::getFlag('gb'); // 🇬🇧
echo FlagsGenerator::getFlag('ua'); // 🇺🇦
echo FlagsGenerator::getFlag('us'); // 🇺🇸
echo FlagsGenerator::getFlag('fr'); // 🇫🇷
```

!!! warning "Throws Exception"
    This method throws `FlagsGeneratorException` if the country code is invalid. Use `getFlagOrNull()` if you want to avoid exceptions.

### getFlagOrNull()

Returns an emoji flag or `null` if the code is invalid. Safe alternative that doesn't throw exceptions.

```php
use Rteeom\FlagsGenerator\FlagsGenerator;

$flag = FlagsGenerator::getFlagOrNull('us'); // 🇺🇸
$invalid = FlagsGenerator::getFlagOrNull('invalid'); // null
$alsoInvalid = FlagsGenerator::getFlagOrNull('xyz'); // null
```

**Use case:** When processing user input or unreliable data sources.

```php
$countryCode = $_POST['country'] ?? '';

$flag = FlagsGenerator::getFlagOrNull($countryCode);

if ($flag !== null) {
    echo "Your flag: $flag";
} else {
    echo "Invalid country code";
}
```

### getAvailableCodes()

Get a list of all supported country codes:

```php
use Rteeom\FlagsGenerator\FlagsGenerator;
use Rteeom\FlagsGenerator\Enums\CodeSet;

// Get all ISO 3166-1 codes (default)
$isoCodes = FlagsGenerator::getAvailableCodes();
// Returns: ['ad', 'ae', 'af', 'ag', ..., 'zm', 'zw']

// Get all codes including extended regional codes
$allCodes = FlagsGenerator::getAvailableCodes(CodeSet::EXTENDED);
// Returns: [..., 'ac', 'dg', 'ea', 'ic', 'ta', 'xk']
```

**Use case:** Populating dropdown lists or validating input.

```php
$availableCodes = FlagsGenerator::getAvailableCodes();

echo "<select name='country'>";
foreach ($availableCodes as $code) {
    $flag = FlagsGenerator::getFlag($code);
    echo "<option value='$code'>$flag " . strtoupper($code) . "</option>";
}
echo "</select>";
```

## Instance Methods (Deprecated)

!!! warning "Deprecated - Will be removed in v2.0"
    Instance methods are deprecated. Use static methods instead.

```php
use Rteeom\FlagsGenerator\FlagsGenerator;

$generator = new FlagsGenerator();

// These methods are deprecated
$flag = $generator->getEmojiFlag('gb'); // ⚠️ Deprecated
$flag = $generator->getEmojiFlagOrNull('ua'); // ⚠️ Deprecated

// Use static methods instead
$flag = FlagsGenerator::getFlag('gb'); // ✅ Recommended
$flag = FlagsGenerator::getFlagOrNull('ua'); // ✅ Recommended
```

## Code Set Selection

You can specify which code set to use:

```php
use Rteeom\FlagsGenerator\FlagsGenerator;
use Rteeom\FlagsGenerator\Enums\CodeSet;

// Standard ISO 3166-1 codes only (default)
$flag = FlagsGenerator::getFlag('gb', CodeSet::ISO3166);

// ISO codes + extended regional codes
$kosovoFlag = FlagsGenerator::getFlag('xk', CodeSet::EXTENDED);
```

Learn more about extended codes in the [Extended Codes](extended-codes.md) section.

## Case Sensitivity

Country codes are **case-insensitive**:

```php
use Rteeom\FlagsGenerator\FlagsGenerator;

// All of these work the same
FlagsGenerator::getFlag('GB');  // 🇬🇧
FlagsGenerator::getFlag('gb');  // 🇬🇧
FlagsGenerator::getFlag('Gb');  // 🇬🇧
FlagsGenerator::getFlag('gB');  // 🇬🇧
```

The library automatically converts input to lowercase internally.

## Next Steps

- [Extended Regional Codes](extended-codes.md) - Kosovo, Ascension Island, etc.
- [Validation](validation.md) - Validate country codes before use
- [Exception Handling](exceptions.md) - Handle invalid codes gracefully
