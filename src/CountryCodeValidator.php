<?php

namespace Rteeom;

class CountryCodeValidator
{
    /**
     * @param string $isoCountryCode
     * @return bool
     */
    public function isValid(string $isoCountryCode): bool
    {
        return strlen($isoCountryCode) === 2;
    }
}