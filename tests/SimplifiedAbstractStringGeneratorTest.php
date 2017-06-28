<?php

declare(strict_types=1);

/*
 * This file is part of Idoheo String Generator package.
 * (c) Repository contributors
 *
 * This source file is subject to the MIT license.
 * Copy of license is located with this source code in the file LICENSE.
 */

namespace Idoheo\Tests\StringGenerator;

use Idoheo\StringGenerator\AbstractStringGenerator;
use Idoheo\StringGenerator\SimplifiedAbstractStringGenerator;
use Idoheo\StringGenerator\StringGeneratorInterface;
use PHPUnit_Framework_MockObject_MockObject as MockObject;

/**
 * @coversDefaultClass \Idoheo\StringGenerator\SimplifiedAbstractStringGenerator
 */
class SimplifiedAbstractStringGeneratorTest extends TestCase
{
    /**
     * @var StringGeneratorInterface|MockObject
     */
    private $stringGenerator;

    protected function setUp()
    {
        parent::setUp();
        $this->stringGenerator = $this->getMockForAbstractClass(SimplifiedAbstractStringGenerator::class);
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
        $length = \random_int(10, 20);
        $string = '';

        for ($i = 1; $i <= $length; ++$i) {
            $char = \base_convert(\random_int(0, 35), 10, 36);
            $string .= $char;

            $this->stringGenerator
                ->expects(static::at($i - 1))
                ->method('getCharacter')
                ->willReturn($char);
        }

        static::assertSame(
            $string,
            $this->stringGenerator->generateString($length),
            \sprintf(
                '%s::%s() failed to return string of requested length. ::%s() might have not executed properly.',
                AbstractStringGenerator::class,
                'generateString',
                'executeStringGeneration'
            )
        );
    }

    /**
     * @covers ::executeStringGeneration
     */
    public function testGenerateString__withMultipleCharactersReturned()
    {
        $length = \random_int(10, 20);
        $string = '';

        for ($i = 1; $i <= $length; ++$i) {
            $char = \base_convert(\random_int(0, 35), 10, 36);
            $string .= $char;
        }

        $this->stringGenerator
            ->expects(static::at(0))
            ->method('getCharacter')
            ->willReturn($string.\microtime(true));

        static::assertSame(
            $string,
            $this->stringGenerator->generateString($length),
            \sprintf(
                '%s::%s() failed to return string of requested length. ::%s() might have not executed properly.',
                AbstractStringGenerator::class,
                'generateString',
                'executeStringGeneration'
            )
        );
    }
}
