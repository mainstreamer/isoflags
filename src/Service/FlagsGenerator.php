<?php

namespace Rteeom\EmojiISOFlagsBundle\Service;

use Rteeom\Exceptions\IsoFlagGeneratorException;

class FlagsGenerator
{
    /**
     * @param string $isoCountryCode
     * @return string
     * @throws IsoFlagGeneratorException
     */
    public function getEmojiFlag(string $isoCountryCode): string
    {
        if (null === $flag = $this->getEmojiFlagOrNull($isoCountryCode)) {
//            throw new IsoFlagGeneratorException();
            throw new \Exception();
        }

        return $flag;
    }

    public function getEmojiFlagOrNull(string $isoCountryCode): ?string
    {
        if ($this->isValid($isoCountryCode)) {
            $first = dechex(ord($isoCountryCode[0])+127365);
            $second = dechex(ord($isoCountryCode[1])+127365);

            return mb_convert_encoding("&#x$first;"."&#x$second;","UTF-8","HTML-ENTITIES");
        }

        return null;
    }

    private function isValid(string $isoCountryCode): bool
    {
        $isoCountryCode = strtoupper($isoCountryCode);
        return (strlen($isoCountryCode) === 2 &&
            preg_match('/^(A(D|E|F|G|I|L|M|N|O|R|S|T|Q|U|W|X|Z)|B(A|B|D|E|F|G|H|I|J|L|M|N|O|R|S|T|V|W|Y|Z)|C(A|C|D|F|G|H|I|K|L|M|N|O|R|U|V|X|Y|Z)|D(E|J|K|M|O|Z)|E(C|E|G|H|R|S|T)|F(I|J|K|M|O|R)|G(A|B|D|E|F|G|H|I|L|M|N|P|Q|R|S|T|U|W|Y)|H(K|M|N|R|T|U)|I(D|E|Q|L|M|N|O|R|S|T)|J(E|M|O|P)|K(E|G|H|I|M|N|P|R|W|Y|Z)|L(A|B|C|I|K|R|S|T|U|V|Y)|M(A|C|D|E|F|G|H|K|L|M|N|O|Q|P|R|S|T|U|V|W|X|Y|Z)|N(A|C|E|F|G|I|L|O|P|R|U|Z)|OM|P(A|E|F|G|H|K|L|M|N|R|S|T|W|Y)|QA|R(E|O|S|U|W)|S(A|B|C|D|E|G|H|I|J|K|L|M|N|O|R|T|V|Y|Z)|T(C|D|F|G|H|J|K|L|M|N|O|R|T|V|W|Z)|U(A|G|M|S|Y|Z)|V(A|C|E|G|I|N|U)|W(F|S)|Y(E|T)|Z(A|M|W))$/i', $isoCountryCode));
    }
}
