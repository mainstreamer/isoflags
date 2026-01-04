<?php declare(strict_types=1);

declare(strict_types=1);

namespace Rteeom\FlagsGenerator;

use Rteeom\FlagsGenerator\Enums\CodeSet;
use Rteeom\FlagsGenerator\Enums\ExtendedCode;
use Rteeom\FlagsGenerator\Enums\IsoCode;

class CountryCodeValidator
{
    public static function isValidCountryCode(string $isoCountryCode, CodeSet $codeSet = CodeSet::ISO3166): bool
    {
        return match ($codeSet) {
            CodeSet::EXTENDED => (bool) ExtendedCode::tryFrom($isoCountryCode),
            CodeSet::ISO3166 => (bool) IsoCode::tryFrom($isoCountryCode),
        };
    }

    /** @deprecated */
    public function isValid(string $isoCountryCode, CodeSet $codeSet = CodeSet::ISO3166): bool
    {
        return self::isValidCountryCode($isoCountryCode, $codeSet);
    }
}
