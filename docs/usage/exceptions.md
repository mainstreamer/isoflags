# Exception Handling

Learn how to handle errors when working with invalid country codes.

## FlagsGeneratorException

When using `getFlag()`, an exception is thrown for invalid country codes.

### Basic Exception Handling

```php
use Rteeom\FlagsGenerator\FlagsGenerator;
use Rteeom\FlagsGenerator\Exceptions\FlagsGeneratorException;

try {
    $flag = FlagsGenerator::getFlag('invalid-code');
} catch (FlagsGeneratorException $e) {
    echo "Error: " . $e->getMessage();
    // Output: "Error: Invalid country code given invalid-code"
}
```

### Exception Message Format

The exception message includes the invalid code:

```php
try {
    FlagsGenerator::getFlag('xyz');
} catch (FlagsGeneratorException $e) {
    echo $e->getMessage();
    // "Invalid country code given xyz"
}
```

## When Exceptions Are Thrown

Exceptions are **only** thrown by the `getFlag()` method:

```php
use Rteeom\FlagsGenerator\FlagsGenerator;

// ✅ This throws an exception
FlagsGenerator::getFlag('invalid'); // Throws FlagsGeneratorException

// ✅ This returns null (no exception)
FlagsGenerator::getFlagOrNull('invalid'); // Returns null
```

## Avoiding Exceptions

If you don't want to deal with exceptions, use `getFlagOrNull()`:

```php
use Rteeom\FlagsGenerator\FlagsGenerator;

$flag = FlagsGenerator::getFlagOrNull('maybe-invalid');

if ($flag === null) {
    echo "Invalid code provided";
} else {
    echo "Flag: $flag";
}
```

## Real-World Example

Processing user input safely:

```php
use Rteeom\FlagsGenerator\FlagsGenerator;
use Rteeom\FlagsGenerator\Exceptions\FlagsGeneratorException;

function displayUserFlag(string $countryCode): void
{
    try {
        $flag = FlagsGenerator::getFlag($countryCode);
        echo "<div class='flag'>$flag</div>";
    } catch (FlagsGeneratorException $e) {
        echo "<div class='error'>Invalid country code</div>";
        error_log($e->getMessage()); // Log for debugging
    }
}

// Usage
displayUserFlag('gb'); // Displays: 🇬🇧
displayUserFlag('invalid'); // Displays error message
```

## Exception with Extended Codes

Exceptions respect the code set:

```php
use Rteeom\FlagsGenerator\FlagsGenerator;
use Rteeom\FlagsGenerator\Enums\CodeSet;
use Rteeom\FlagsGenerator\Exceptions\FlagsGeneratorException;

try {
    // Kosovo (XK) is not in ISO 3166-1
    FlagsGenerator::getFlag('xk', CodeSet::ISO3166);
} catch (FlagsGeneratorException $e) {
    echo $e->getMessage();
    // "Invalid country code given xk"
}

// But this works (XK is in extended set)
$flag = FlagsGenerator::getFlag('xk', CodeSet::EXTENDED); // 🇽🇰
```

## Best Practices

### When to Use Exceptions

Use `getFlag()` with exception handling when:

- Invalid input should be considered an error
- You want to log/track invalid codes
- You're working with trusted data sources

```php
use Rteeom\FlagsGenerator\FlagsGenerator;
use Rteeom\FlagsGenerator\Exceptions\FlagsGeneratorException;

function processOrder(array $order): void
{
    try {
        // Order should always have valid country
        $flag = FlagsGenerator::getFlag($order['country']);
        // ... process order
    } catch (FlagsGeneratorException $e) {
        // This indicates data corruption - log it!
        error_log("Invalid country in order: " . $e->getMessage());
        throw new \RuntimeException("Order data is invalid");
    }
}
```

### When to Use getFlagOrNull()

Use `getFlagOrNull()` when:

- Invalid input is expected/acceptable
- You're processing user input
- You want simpler code without try-catch

```php
use Rteeom\FlagsGenerator\FlagsGenerator;

function displayOptionalFlag(?string $countryCode): void
{
    $flag = FlagsGenerator::getFlagOrNull($countryCode ?? '');

    if ($flag !== null) {
        echo "<span>$flag</span>";
    }
    // Silently ignore invalid codes
}
```

## Exception Hierarchy

```
\Exception
  └── FlagsGeneratorException
```

You can catch it as a general exception:

```php
try {
    $flag = FlagsGenerator::getFlag('invalid');
} catch (\Exception $e) {
    // This will catch FlagsGeneratorException
    echo "Something went wrong: " . $e->getMessage();
}
```

## Next Steps

- [Validation](validation.md) - Validate codes before use
- [Extended Codes](extended-codes.md) - Learn about extended codes
- [API Reference](../api-reference.md) - Complete API documentation
