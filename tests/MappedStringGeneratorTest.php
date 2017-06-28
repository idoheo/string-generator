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

use Idoheo\StringGenerator\MappedStringGenerator;
use Idoheo\StringGenerator\StringGeneratorInterface;
use PHPUnit_Framework_MockObject_MockObject as MockObject;

/**
 * @coversDefaultClass \Idoheo\StringGenerator\MappedStringGenerator
 */
class MappedStringGeneratorTest extends TestCase
{
    /**
     * @var StringGeneratorInterface|MockObject
     */
    private $stringGenerator;

    protected function tearDown()
    {
        $this->stringGenerator = null;
        parent::tearDown();
    }

    /**
     * @covers ::__construct
     */
    public function testConstruct()
    {
        $min = \ord('a');
        $max = \ord('z');

        $charactersCount = 4;
        $characters      = [];
        $split           = ($max - $min + 2) / $charactersCount;

        for ($i = 1; $i <= $charactersCount; ++$i) {
            $charMin = (int) \floor(($i - 1) * $split);
            $charMax = (int) \floor($i * $split) - 1;

            $characters[] = \chr(\random_int($charMin, $charMax));
        }

        $this->setMap($characters);
        $reflection = new \ReflectionClass($this->stringGenerator);
        $set        = [];
        foreach ($reflection->getProperties() as $property) {
            $property->setAccessible(true);
            $set[$property->getName()] = $property->getValue($this->stringGenerator);
        }

        $expected = [
            'characters' => $characters,
        ];

        \ksort($set);
        \ksort($expected);

        static::assertSame(
            $expected,
            $set,
            \sprintf(
                '%s::%s() failed to initialize object as expected.',
                \get_class($this->stringGenerator),
                '__construct'
            )
        );
    }

    /**
     * @covers ::getCharacter
     * @depends testConstruct
     */
    public function testGenerateString()
    {
        $tests = 3;
        $div   = (int) (\floor(36 / $tests));

        for ($i = 0; $i < $tests; ++$i) {
            $char   = \base_convert(\random_int($i * $div, ($i + 1) * $div - 1), 10, 36);
            $length = \random_int(10, 20);

            $this->setMap([$char]);

            static::assertSame(
                \implode('', \array_fill(0, $length, $char)),
                $this->stringGenerator->generateString($length),
                \sprintf(
                    '%s::%s() failed to return expected result for single character map.',
                    \get_class($this->stringGenerator),
                    'generateString'
                )
            );
        }

        $alphaNum = [];
        for ($i = 1; $i <= 36; ++$i) {
            $alphaNum[] = \base_convert($i - 1, 10, 36);
        }
        $this->setMap($alphaNum);

        $string = $this->stringGenerator->generateString(36 * 2);
        static::assertRegExp(
            \sprintf('/^[0-9a-z]{%d}$/', 36 * 2),
            $string,
            \sprintf(
                '%s::%s() failed to return expected result for multi character map.',
                \get_class($this->stringGenerator),
                'generateString'
            )
        );

        static::assertGreaterThan(
            2,
            \count(\array_unique(\str_split($string, 1))),
            \sprintf(
                '%s::%s() failed to return expected result for multi character map.',
                \get_class($this->stringGenerator),
                'generateString'
            )
        );
    }

    protected function setMap(array $characters)
    {
        $this->stringGenerator = new MappedStringGenerator($characters);
    }
}
