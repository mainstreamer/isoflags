<?php

namespace Rteeom\FlagsGenerator\Exceptions;

use ErrorException;

class IsoFlagGeneratorException extends ErrorException
{
    /** @var string */
    protected $message = 'Invalid iso country code, please refer to https://en.wikipedia.org/wiki/List_of_ISO_3166_country_codes';
    /** @var int */
    protected $code = 405;

    public function __construct(
        $message = "",
        $code = 0,
        $severity = 1,
        $filename = __FILE__,
        $line = __LINE__,
        $previous = null
    ) {
        parent::__construct(
            sprintf('%s %s', $message, $this->message),
            $code,
            $severity,
            $filename,
            $line,
            $previous
        );
    }
}
