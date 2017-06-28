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

use Idoheo\StringGenerator\AbstractStringGenerator;

/**
 * String generator returning hexadecimal string (lowercase).
 */
class HexStringGenerator extends AbstractStringGenerator
{
    /**
     * {@inheritdoc}
     */
    protected function executeStringGeneration(int $length): string
    {
        $callable = \function_exists('openssl_random_pseudo_bytes') ? 'openssl_random_pseudo_bytes' : 'random_bytes';
        $string   = '';
        while (\mb_strlen($string) < $length) {
            $missing = $length - \mb_strlen($string);
            $bytes   = ($missing - $missing % 2) / 2 + ($missing % 2);
            $gen     = \call_user_func_array($callable, [$bytes]);
            $string .= \bin2hex($gen);
        }

        return \mb_substr($string, 0, $length);
    }
}
