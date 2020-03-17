<?php

namespace Rteeom\Exceptions;

use Rteeom\CountryCodeValidator;

class IsoFlagGeneratorException extends \Exception
{
    /**
     * @var string
     */
    protected $message = 'Invalid iso country code, please refer to https://en.wikipedia.org/wiki/List_of_ISO_3166_country_codes';
    protected $code = 405;
}

