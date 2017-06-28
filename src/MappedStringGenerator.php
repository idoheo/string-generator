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
 * String generator using predefined characters list.
 */
class MappedStringGenerator extends SimplifiedAbstractStringGenerator
{
    /**
     * @var string[] Array of characters to use
     */
    protected $characters = [];

    /**
     * MappedStringGenerator constructor.
     *
     * @param string[] $characters Array of characters to use
     */
    public function __construct(array $characters)
    {
        $this->characters = $characters;
    }

    /**
     * {@inheritdoc}
     */
    public function getCharacter(): string
    {
        return $this->characters[\array_rand($this->characters, 1)];
    }
}
