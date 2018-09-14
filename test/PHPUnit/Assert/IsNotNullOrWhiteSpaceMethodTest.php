<?php

namespace Fabstract\Component\Assert\Test\PHPUnit\Assert;

use Fabstract\Component\Assert\Assert;
use Fabstract\Component\Assert\AssertionException;
use Fabstract\Component\UnitTest\MethodTestBase;

/**
 * Class IsNotNullOrWhiteSpaceMethodTest
 * @package Fabstract\Component\Assert\Test\PHPUnit\Assert
 *
 * @see \Fabstract\Component\Assert\Assert::isNotNullOrWhiteSpace()
 */
class IsNotNullOrWhiteSpaceMethodTest extends MethodTestBase
{

    #region correct arguments

    /**
     * @doesNotPerformAssertions
     */
    public function testStringWithoutSpaceDoesNotThrow()
    {
        $argument = ['a'];

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

    public function testEmptyStringThrows()
    {
        $argument = [''];

        $this->expectException(AssertionException::class);

        $this->callStatic(Assert::class, $argument);
    }

    public function testIntThrows()
    {
        $argument = [1];

        $this->expectException(AssertionException::class);

        $this->callStatic(Assert::class, $argument);
    }


    public function testStringWithSpaceThrows()
    {
        $argument = [' '];

        $this->expectException(AssertionException::class);

        $this->callStatic(Assert::class, $argument);
    }

    #endregion
}
