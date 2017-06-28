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
 * Interface for string generator.
 */
interface StringGeneratorInterface
{
    /**
     * Generates string of specific length.
     *
     * @param int $length String length
     *
     * @throws DomainException if length is a negative number
     *
     * @return string Generated string
     */
    public function generateString(int $length): string;
}
