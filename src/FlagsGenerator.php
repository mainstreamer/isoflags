<?php

namespace App;

use App\CountryCodeValidator;
use App\Exceptions\IsoFlagGeneratorException;

class FlagsGenerator
{
    /**
     * @var \App\CountryCodeValidator
     */
    private CountryCodeValidator $validator;

    public function __construct(CountryCodeValidator $validator)
    {
        $this->validator = $validator;
    }

    /**
     * @param string $isoCountryCode
     * @return string
     * @throws IsoFlagGeneratorException
     * @throws \ErrorException
     */
    public function getEmojiFlag(string $isoCountryCode): string
    {
        if ($this->validator->isValid($isoCountryCode)) {
            $first = dechex(ord($isoCountryCode[0])+127365);
            $second = dechex(ord($isoCountryCode[1])+127365);
            return mb_convert_encoding("&#x$first;"."&#x$second;","UTF-8","HTML-ENTITIES");
        }

        throw new IsoFlagGeneratorException();
    }
}

//throw new \ErrorException('invalid iso country code, please refer to');