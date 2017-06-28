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

use Idoheo\StringGenerator\StringGenerator\NqCharStringGenerator;
use Idoheo\Tests\StringGenerator\TestCase;

/**
 * @coversDefaultClass \Idoheo\StringGenerator\StringGenerator\NqCharStringGenerator
 */
class NqCharStringGeneratorTest extends TestCase
{
    /**
     * @var NqCharStringGenerator
     */
    private $stringGenerator;

    protected function setUp()
    {
        parent::setUp();
        $this->stringGenerator = new NqCharStringGenerator();
    }

    protected function tearDown()
    {
        $this->stringGenerator = null;
        parent::tearDown();
    }

    /**
     * @covers ::__construct
     */
    public function testMap()
    {
        $characters = [];
        foreach (
            [
                ['21', '21'],
                ['23', '5B'],
                ['5D', '7E'],
            ]
        as $list) {
            list($hexStart, $hexStop) = $list;
            for ($i = \hexdec($hexStart); $i <= \hexdec($hexStop); ++$i) {
                $characters[] = \chr($i);
            }
        }

        static::assertEquals(
            $characters,
            static::getObjectAttribute($this->stringGenerator, 'characters'),
            \sprintf(
                '%s::$%s has unexpected characters map.',
                \get_class($this->stringGenerator),
                'characters'
            ),
            0,
            0,
            true,
            false
        );
    }

    /**
     * @depends testMap
     */
    public function testGenerateString()
    {
        for ($i = 1; $i <= 5; ++$i) {
            $length = \random_int(50, 60);
            static::assertRegExp(
                \sprintf('/^[\x{21}\x{23}-\x{5B}\x{5D}-\x{7E}]{%d}$/u', $length),
                $this->stringGenerator->generateString($length),
                \sprintf(
                    '%s::%s() failed to produce expected string.',
                    \get_class($this->stringGenerator),
                    'generateString'
                )
            );
        }
    }
}
