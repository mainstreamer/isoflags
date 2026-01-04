<?php

declare(strict_types=1);

namespace Rteeom\FlagsGenerator;

use Rteeom\FlagsGenerator\Enums\CodeSet;
use Rteeom\FlagsGenerator\Enums\ExtendedCode;
use Rteeom\FlagsGenerator\Enums\IsoCode;
use Rteeom\FlagsGenerator\Exceptions\FlagsGeneratorException;

final class FlagsGenerator
{
    /**
     * @deprecated Use static getFlag() instead. This will be removed in v2.0.
     * @see FlagsGenerator::getFlag()
     *
     * @throws FlagsGeneratorException
     */
    public function getEmojiFlag(string $isoCountryCode, CodeSet $codeSet = CodeSet::ISO3166): string
    {
        return self::getFlag($isoCountryCode, $codeSet);
    }

    /**
     * @deprecated Use static getFlagOrNull() instead. This will be removed in v2.0.
     * @see FlagsGenerator::getFlagOrNull()
     */
    public function getEmojiFlagOrNull(string $isoCode, CodeSet $codeSet = CodeSet::ISO3166): ?string
    {
        return self::getFlagOrNull($isoCode, $codeSet);
    }

    public static function getFlagOrNull(string $isoCode, CodeSet $codeSet = CodeSet::ISO3166): ?string
    {
        $isoCode = strtolower($isoCode);

        if (CountryCodeValidator::isValidCountryCode($isoCode, $codeSet)) {
            $firstCodepoint = ord($isoCode[0]) + 127365;
            $secondCodepoint = ord($isoCode[1]) + 127365;

            return self::codepointToUtf8($firstCodepoint) . self::codepointToUtf8($secondCodepoint);
        }

        return null;
    }

    /**
     * Converts a Unicode codepoint to UTF-8 bytes.
     * Regional Indicator Symbols are 4-byte UTF-8 characters (U+1F1E6 to U+1F1FF).
     */
    private static function codepointToUtf8(int $codepoint): string
    {
        return pack(
            'C*',
            0xF0 | ($codepoint >> 18),
            0x80 | (($codepoint >> 12) & 0x3F),
            0x80 | (($codepoint >> 6) & 0x3F),
            0x80 | ($codepoint & 0x3F),
        );
    }

    /**
     * @throws FlagsGeneratorException
     */
    public static function getFlag(string $isoCode, CodeSet $codeSet = CodeSet::ISO3166): string
    {
        return self::getFlagOrNull($isoCode, $codeSet)
            ?? throw new FlagsGeneratorException($isoCode);
    }

    public static function getAvailableCodes(CodeSet $codeSet = CodeSet::ISO3166): array
    {
        return match ($codeSet) {
            CodeSet::ISO3166 => array_column(IsoCode::cases(), 'value'),
            CodeSet::EXTENDED => array_column(ExtendedCode::cases(), 'value'),
        };
    }
}
