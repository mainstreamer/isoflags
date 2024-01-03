<?php

namespace Rteeom\FlagsGenerator;

use Rteeom\FlagsGenerator\Exceptions\IsoFlagGeneratorException;

class FlagsGenerator
{
    private const ENCODING_UTF8 = 'UTF-8';
    private const ENCODING_HTML_ENTITIES = 'HTML-ENTITIES';
    private CountryCodeValidator $validator;

    public function __construct()
    {
        $this->validator = new CountryCodeValidator();
    }

    /**
     * @param string $isoCountryCode
     * @return string
     * @throws IsoFlagGeneratorException
     */
    public function getEmojiFlag(string $isoCountryCode): string
    {
        if (null === $flag = $this->getEmojiFlagOrNull($isoCountryCode)) {
            throw new IsoFlagGeneratorException($isoCountryCode);
        }

        return $flag;
    }

    public function getEmojiFlagOrNull(string $isoCountryCode): ?string
    {
        if ($this->validator->isValid($isoCountryCode)) {
            $first = dechex(ord($isoCountryCode[0])+127365);
            $second = dechex(ord($isoCountryCode[1])+127365);

            return mb_convert_encoding(
                "&#x$first;"."&#x$second;",
                self::ENCODING_UTF8,
                self::ENCODING_HTML_ENTITIES
            );
        }

        return null;
    }
}
