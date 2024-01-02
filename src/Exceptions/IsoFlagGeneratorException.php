<?php

namespace Rteeom\FlagsGenerator\Exceptions;

class IsoFlagGeneratorException extends \ErrorException
{
    /** @var string */
    protected $message = 'Invalid iso country code, please refer to https://en.wikipedia.org/wiki/List_of_ISO_3166_country_codes';
    /** @var int */
    protected $code = 405;
}
