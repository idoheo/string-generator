<?php

declare(strict_types=1);

/*
 * This file is part of Idoheo String Generator package.
 * (c) Repository contributors
 *
 * This source file is subject to the MIT license.
 * Copy of license is located with this source code in the file LICENSE.
 */

namespace Idoheo\StringGenerator;

/**
 * Abstract string generator, pre-checking valid $length parameter and composing string from single characters
 * returned by ::getCharacter.
 */
abstract class SimplifiedAbstractStringGenerator extends AbstractStringGenerator
{
    /**
     * {@inheritdoc}
     */
    protected function executeStringGeneration(int $length): string
    {
        $string = '';
        while (\mb_strlen($string) < $length) {
            $string .= $this->getCharacter();
        }

        return \mb_substr($string, 0, $length);
    }

    /**
     * Generates a (single) character string.
     *
     * @return string Single character
     */
    abstract protected function getCharacter(): string;
}
