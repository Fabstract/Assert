<?php

namespace Fabstract\Component\Assert\Test\PHPUnit\Assert;

use Fabstract\Component\Assert\Assert;
use Fabstract\Component\Assert\AssertionException;
use Fabstract\Component\UnitTest\MethodTestBase;

/**
 * Class IsFloatMethodTest
 * @package Fabstract\Component\Assert\Test\PHPUnit\Assert
 *
 * @see \Fabstract\Component\Assert\Assert::isFloat()
 */
class IsFloatMethodTest extends MethodTestBase
{

    #region correct arguments

    /**
     * @doesNotPerformAssertions
     */
    public function testFloatOneDoesNotThrow()
    {
        $argument = [1.0];

        $this->callStatic(Assert::class, $argument);
    }

    /**
     * @doesNotPerformAssertions
     */
    public function testFloatZeroDoesNotThrow()
    {
        $argument = [0.0];

        $this->callStatic(Assert::class, $argument);
    }

    /**
     * @doesNotPerformAssertions
     */
    public function testINFDoesNotThrow()
    {
        $argument = [INF];

        $this->callStatic(Assert::class, $argument);
    }

    #endregion

    #region incorrect arguments

    public function testIntOneThrows()
    {
        $argument = [1];

        $this->expectException(AssertionException::class);

        $this->callStatic(Assert::class, $argument);
    }

    public function testIntZeroThrows()
    {
        $argument = [0];

        $this->expectException(AssertionException::class);

        $this->callStatic(Assert::class, $argument);
    }

    public function testNullThrows()
    {
        $argument = [null];

        $this->expectException(AssertionException::class);

        $this->callStatic(Assert::class, $argument);
    }

    #endregion
}
