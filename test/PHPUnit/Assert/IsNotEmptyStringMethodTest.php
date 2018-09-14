<?php

namespace Fabstract\Component\Assert\Test\PHPUnit\Assert;

use Fabstract\Component\Assert\Assert;
use Fabstract\Component\Assert\AssertionException;
use Fabstract\Component\UnitTest\MethodTestBase;

/**
 * Class IsNotEmptyStringMethodTest
 * @package Fabstract\Component\Assert\Test\PHPUnit\Assert
 *
 * @see \Fabstract\Component\Assert\Assert::isNotEmptyString()
 */
class IsNotEmptyStringMethodTest extends MethodTestBase
{

    #region correct arguments

    /**
     * @doesNotPerformAssertions
     */
    public function testStringWithSpaceWithAcceptBlanksTrueDoesNotThrow()
    {
        $argument = [' ', true];

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


    public function testStringWithSpaceWithAcceptBlanksFalseThrows()
    {
        $argument = [' '];

        $this->expectException(AssertionException::class);

        $this->callStatic(Assert::class, $argument);
    }

    #endregion
}
