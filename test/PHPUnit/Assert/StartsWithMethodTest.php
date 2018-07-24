<?php

namespace Fabstract\Component\Assert\Test\PHPUnit\Assert;

use Fabstract\Component\Assert\Assert;
use Fabstract\Component\Assert\AssertionException;
use Fabstract\Component\Assert\Test\PHPUnit\MethodTestBase;

/**
 * Class StartsWithMethodTest
 * @package Fabstract\Component\Assert\Test\PHPUnit\Assert
 *
 * @see \Fabstract\Component\Assert\Assert::startsWith()
 */
class StartsWithMethodTest extends MethodTestBase
{

    #region correct arguments

    /**
     * @doesNotPerformAssertions
     */
    public function testTheSameStringDoesNotThrow()
    {
        $argument = ['example', 'example'];

        $this->callStatic(Assert::class, $argument);
    }

    /**
     * @doesNotPerformAssertions
     */
    public function testSpaceDoesNotThrow()
    {
        $argument = [' example', ' '];

        $this->callStatic(Assert::class, $argument);
    }


    /**
     * @doesNotPerformAssertions
     */
    public function testEmptyStringDoesNotThrow()
    {
        $argument = ['', ''];

        $this->callStatic(Assert::class, $argument);
    }


    /**
     * @doesNotPerformAssertions
     */
    public function testSubstringDoesNotThrow()
    {
        $argument = ['example', 'exam'];

        $this->callStatic(Assert::class, $argument);
    }

    #endregion

    #region incorrect arguments

    public function testNullThrows()
    {
        $argument = [null, null];

        $this->expectException(AssertionException::class);

        $this->callStatic(Assert::class, $argument);
    }

    public function testDifferentFirstCharacterThrows()
    {
        $argument = ['example', 'bxample'];

        $this->expectException(AssertionException::class);

        $this->callStatic(Assert::class, $argument);
    }

    #endregion
}
