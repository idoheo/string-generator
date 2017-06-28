<?php

declare(strict_types=1);

/*
 * This file is part of Idoheo String Generator package.
 * (c) Repository contributors
 *
 * This source file is subject to the MIT license.
 * Copy of license is located with this source code in the file LICENSE.
 */

namespace Idoheo\Tests\StringGenerator\StringGenerator;

use Idoheo\StringGenerator\StringGenerator\HexStringGenerator;
use Idoheo\Tests\StringGenerator\TestCase;

/**
 * @coversDefaultClass \Idoheo\StringGenerator\StringGenerator\HexStringGenerator
 */
class HexStringGeneratorTest extends TestCase
{
    /**
     * @var HexStringGenerator
     */
    private $stringGenerator;

    protected function setUp()
    {
        parent::setUp();
        $this->stringGenerator = new HexStringGenerator();
    }

    protected function tearDown()
    {
        $this->stringGenerator = null;
        parent::tearDown();
    }

    /**
     * @covers ::executeStringGeneration
     */
    public function testGenerateString()
    {
        $stringsCount = 10;
        $strings      = [];

        for ($i = 1; $i <= $stringsCount; ++$i) {
            $length = \random_int(40, 80);
            $string = $this->stringGenerator->generateString($length);
            static::assertRegExp(
                \sprintf(
                    '/^[0-9a-f]{%d}$/',
                    $length
                ),
                $string,
                \sprintf(
                    '%s::%s() failed to return expected result.',
                    \get_class($this->stringGenerator),
                    'generateString'
                )
            );
            $strings[] = $string;
        }

        static::assertCount(
            $stringsCount,
            \array_unique($strings),
            \sprintf(
                '%s::%s() failed to produce %d unique strings.',
                \get_class($this->stringGenerator),
                'generateString',
                $stringsCount
            )
        );
    }
}
