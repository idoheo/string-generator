<?php

declare(strict_types=1);

/*
 * This file is part of Idoheo String Generator package.
 * (c) Repository contributors
 *
 * This source file is subject to the MIT license.
 * Copy of license is located with this source code in the file LICENSE.
 */

namespace Idoheo\StringGenerator\StringGenerator;

use Idoheo\StringGenerator\MappedStringGenerator;

/**
 * String generator generating NQSCHAR string
 * NQSCHAR = %x20-21 / %x23-5B / %x5D-7E.
 */
class NqsCharStringGenerator extends MappedStringGenerator
{
    /**
     * NqsCharStringGenerator constructor.
     */
    public function __construct()
    {
        parent::__construct(
            [
                ' ',
                '!',
                '#',
                '$',
                '%',
                '&',
                '\'',
                '(',
                ')',
                '*',
                '+',
                ',',
                '-',
                '.',
                '/',
                '0',
                '1',
                '2',
                '3',
                '4',
                '5',
                '6',
                '7',
                '8',
                '9',
                ':',
                ';',
                '<',
                '=',
                '>',
                '?',
                '@',
                'A',
                'B',
                'C',
                'D',
                'E',
                'F',
                'G',
                'H',
                'I',
                'J',
                'K',
                'L',
                'M',
                'N',
                'O',
                'P',
                'Q',
                'R',
                'S',
                'T',
                'U',
                'V',
                'W',
                'X',
                'Y',
                'Z',
                '[',
                ']',
                '^',
                '_',
                '`',
                'a',
                'b',
                'c',
                'd',
                'e',
                'f',
                'g',
                'h',
                'i',
                'j',
                'k',
                'l',
                'm',
                'n',
                'o',
                'p',
                'q',
                'r',
                's',
                't',
                'u',
                'v',
                'w',
                'x',
                'y',
                'z',
                '{',
                '|',
                '}',
                '~',
            ]
        );
    }
}
