<?php declare(strict_types=1);

namespace Rteeom\FlagsGenerator;

use Rteeom\FlagsGenerator\Enums\CodeSet;
use Rteeom\FlagsGenerator\Enums\ExtendedCode;
use Rteeom\FlagsGenerator\Enums\IsoCode;
use Rteeom\FlagsGenerator\Exceptions\FlagsGeneratorException;

class FlagsGenerator
{
    private const string ENCODING_UTF8 = 'UTF-8';
    private const string ENCODING_HTML_ENTITIES = 'HTML-ENTITIES';

    /**
     * @deprecated Use static getFlag() instead. This will be removed in v2.0.
     * @see FlagsGenerator::getFlag()
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
            $first = dechex(ord($isoCode[0]) + 127365);
            $second = dechex(ord($isoCode[1]) + 127365);

            return mb_convert_encoding(
                string: "&#x$first;" . "&#x$second;",
                to_encoding: self::ENCODING_UTF8,
                from_encoding: self::ENCODING_HTML_ENTITIES,
            );
        }

        return null;
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
