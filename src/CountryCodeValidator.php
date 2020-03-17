<?php

namespace Rteeom;

class CountryCodeValidator
{
    /**
     * @param string $isoCountryCode
     * @return bool
     * @throws \ErrorException
     */
    public function isValid(string $isoCountryCode): bool
    {
        return strlen($isoCountryCode) === 2;
    }
}