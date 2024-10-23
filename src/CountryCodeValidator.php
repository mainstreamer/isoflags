<?php

namespace Rteeom\FlagsGenerator;

class CountryCodeValidator
{
    public const PATTERNS = [
        self::A_PATTERN,
        self::B_PATTERN,
        self::C_PATTERN,
        self::D_PATTERN,
        self::E_PATTERN,
        self::F_PATTERN,
        self::G_PATTERN,
        self::H_PATTERN,
        self::I_PATTERN,
        self::J_PATTERN,
        self::K_PATTERN,
        self::L_PATTERN,
        self::M_PATTERN,
        self::N_PATTERN,
        self::O_PATTERN,
        self::P_PATTERN,
        self::Q_PATTERN,
        self::R_PATTERN,
        self::S_PATTERN,
        self::T_PATTERN,
        self::U_PATTERN,
        self::V_PATTERN,
        self::W_PATTERN,
        self::X_PATTERN,
        self::Y_PATTERN,
        self::Z_PATTERN,
    ];
    public const A_PATTERN = 'A(D|E|F|G|I|L|M|N|O|R|S|T|Q|U|W|X|Z)';
    public const B_PATTERN = 'B(A|B|D|E|F|G|H|I|J|L|M|N|O|Q|R|S|T|V|W|Y|Z)';
    public const C_PATTERN = 'C(A|C|D|F|G|H|I|K|L|M|N|O|R|U|V|W|X|Y|Z)';
    public const D_PATTERN = 'D(E|J|K|M|O|Z)';
    public const E_PATTERN = 'E(C|E|G|H|R|S|T)';
    public const F_PATTERN = 'F(I|J|K|M|O|R)';
    public const G_PATTERN = 'G(A|B|D|E|F|G|H|I|L|M|N|P|Q|R|S|T|U|W|Y)';
    public const H_PATTERN = 'H(K|M|N|R|T|U)';
    public const I_PATTERN = 'I(D|E|Q|L|M|N|O|R|S|T)';
    public const J_PATTERN = 'J(E|M|O|P)';
    public const K_PATTERN = 'K(E|G|H|I|M|N|P|R|W|Y|Z)';
    public const L_PATTERN = 'L(A|B|C|I|K|R|S|T|U|V|Y)';
    public const M_PATTERN = 'M(A|C|D|E|F|G|H|K|L|M|N|O|Q|P|R|S|T|U|V|W|X|Y|Z)';
    public const N_PATTERN = 'N(A|C|E|F|G|I|L|O|P|R|U|Z)';
    public const O_PATTERN = 'O(M)';
    public const P_PATTERN = 'P(A|E|F|G|H|K|L|M|N|R|S|T|W|Y)';
    public const Q_PATTERN = 'Q(A)';
    public const R_PATTERN = 'R(E|O|S|U|W)';
    public const S_PATTERN = 'S(A|B|C|D|E|G|H|I|J|K|L|M|N|O|R|S|T|V|X|Y|Z)';
    public const T_PATTERN = 'T(C|D|F|G|H|J|K|L|M|N|O|R|T|V|W|Z)';
    public const U_PATTERN = 'U(A|G|M|S|Y|Z)';
    public const V_PATTERN = 'V(A|C|E|G|I|N|U)';
    public const W_PATTERN = 'W(F|S)';
    public const X_PATTERN = 'X(K)';
    public const Y_PATTERN = 'Y(E|T)';
    public const Z_PATTERN = 'Z(A|M|W)';

    /**
     * requires ISO 3166-1 country code e.g. GB
     * @param string $isoCountryCode
     * @return bool
     */
    public function isValid(string $isoCountryCode): bool
    {
        $pattern = sprintf('/^(%s)$/i', implode('|', self::PATTERNS));

        return (
            strlen($isoCountryCode) === 2 &&
            preg_match($pattern, strtoupper($isoCountryCode))
        );
    }
}
