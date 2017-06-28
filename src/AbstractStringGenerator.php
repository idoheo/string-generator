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

use DomainException;

/**
 * Abstract string generator, pre-checking valid $length parameter.
 */
abstract class AbstractStringGenerator implements StringGeneratorInterface
{
    /**
     * {@inheritdoc}
     */
    public function generateString(int $length): string
    {
        if ($length < 0) {
            throw new DomainException(
                \sprintf(
                    'Invalid string length specified: %d.',
                    $length
                )
            );
        }

        return $this->executeStringGeneration($length);
    }

    /**
     * Generates string of specific length.
     *
     * @param int $length Non negative string length
     *
     * @return string
     */
    abstract protected function executeStringGeneration(int $length): string;
}
