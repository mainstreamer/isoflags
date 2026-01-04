<?php

namespace Rteeom\FlagsGenerator\Exceptions;

use ErrorException;

class FlagsGeneratorException extends ErrorException
{
    private const string MESSAGE = 'Invalid country code given';

    public function __construct(
        string $isoCode,
    ) {
        parent::__construct(message: sprintf('%s %s', self::MESSAGE, $isoCode));
    }
}
