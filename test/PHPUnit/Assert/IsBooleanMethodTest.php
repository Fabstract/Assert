<?php

namespace Fabstract\Component\Assert\Test\PHPUnit\Assert;

use Fabstract\Component\Assert\Assert;
use Fabstract\Component\Assert\AssertionException;
use Fabstract\Component\UnitTest\MethodTestBase;

/**
 * Class IsBooleanMethodTest
 * @package Fabstract\Component\Assert\Test\PHPUnit\Assert
 *
 * @see \Fabstract\Component\Assert\Assert::isBoolean()
 */
class IsBooleanMethodTest extends MethodTestBase
{

    #region correct arguments

    /**
     * @doesNotPerformAssertions
     */
    public function testFalseDoesNotThrow()
    {
        $argument = [false];

        $this->callStatic(Assert::class, $argument);
    }

    /**
     * @doesNotPerformAssertions
     */
    public function testTrueDoesNotThrow()
    {
        $argument = [true];

        $this->callStatic(Assert::class, $argument);
    }

    #endregion

    #region incorrect arguments

    public function testNullThrows()
    {
        $argument = [null];

        $this->expectException(AssertionException::class);

        $this->callStatic(Assert::class, $argument);
    }

    public function testStringOneThrows()
    {
        $argument = ['1'];

        $this->expectException(AssertionException::class);

        $this->callStatic(Assert::class, $argument);
    }

    public function testIntOneThrows()
    {
        $argument = [1];

        $this->expectException(AssertionException::class);

        $this->callStatic(Assert::class, $argument);
    }

    public function testStringZeroThrows()
    {
        $argument = ['0'];

        $this->expectException(AssertionException::class);

        $this->callStatic(Assert::class, $argument);
    }

    public function testIntZeroThrows()
    {
        $argument = [0];

        $this->expectException(AssertionException::class);

        $this->callStatic(Assert::class, $argument);
    }

    #endregion
}
