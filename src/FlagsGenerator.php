<?php

namespace Rteeom;

use Rteeom\Exceptions\IsoFlagGeneratorException;

class FlagsGenerator
{
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
            throw new IsoFlagGeneratorException();
        }

        return $flag;
    }

    public function getEmojiFlagOrNull(string $isoCountryCode): ?string
    {
        if ($this->validator->isValid($isoCountryCode)) {
            $first = dechex(ord($isoCountryCode[0])+127365);
            $second = dechex(ord($isoCountryCode[1])+127365);

            return mb_convert_encoding("&#x$first;"."&#x$second;","UTF-8","HTML-ENTITIES");
        }

        return null;
    }
}
