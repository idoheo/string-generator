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
use Idoheo\StringGenerator\StringGeneratorInterface;
use PHPUnit_Framework_MockObject_MockObject as MockObject;

/**
 * @coversDefaultClass \Idoheo\StringGenerator\AbstractStringGenerator
 */
class AbstractStringGeneratorTest extends TestCase
{
    /**
     * @var StringGeneratorInterface|MockObject
     */
    private $stringGenerator;

    protected function setUp()
    {
        parent::setUp();
        $this->stringGenerator = $this->getMockForAbstractClass(AbstractStringGenerator::class);
    }

    protected function tearDown()
    {
        $this->stringGenerator = null;
        parent::tearDown();
    }

    /**
     * @covers ::generateString
     */
    public function testGenerateString__success__lengthPositive()
    {
        $length = \random_int(10, 20);
        $char   = \base_convert(\random_int(0, 35), 10, 36);
        $string = \implode('', \array_fill(0, $length, $char));

        $this->stringGenerator
            ->expects(static::once())
            ->method('executeStringGeneration')
            ->with($length)
            ->willReturn($string);

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
     * @covers ::generateString
     */
    public function testGenerateString__success__lengthZero()
    {
        $length = 0;
        $string = '';

        $this->stringGenerator
            ->expects(static::once())
            ->method('executeStringGeneration')
            ->with($length)
            ->willReturn($string);

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
     * @covers ::generateString
     * @expectedException \DomainException
     * @expectedExceptionMessage Invalid string length specified: -1.
     */
    public function testGenerateString__failure__lengthNegative()
    {
        $length = -1;
        $string = '';

        $this->stringGenerator
            ->expects(static::never())
            ->method('executeStringGeneration');

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
