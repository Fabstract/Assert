<?php

namespace Fabstract\Component\Assert\Test\PHPUnit\Assert;

use Fabstract\Component\Assert\Assert;
use Fabstract\Component\Assert\AssertionException;
use Fabstract\Component\UnitTest\MethodTestBase;

class IsPositiveNumberMethodTest extends MethodTestBase
{

    #region correct arguments

    /**
     * @doesNotPerformAssertions
     */
    public function testPositiveOneDoesNotThrow()
    {
        $argument = [1];

        $this->callStatic(Assert::class, $argument);
    }

    /**
     * @doesNotPerformAssertions
     */
    public function testPositiveFloatOneDoesNotThrow()
    {
        $argument = [1.0];

        $this->callStatic(Assert::class, $argument);
    }

    /**
     * @doesNotPerformAssertions
     */
    public function testPositiveInfinityDoesNotThrow()
    {
        $argument = [INF];

        $this->callStatic(Assert::class, $argument);
    }

    /**
     * @doesNotPerformAssertions
     */
    public function testStringOneWithAllowStringSetToTrueDoesNotThrow()
    {
        $argument = ['1', true];

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

    public function testZeroThrows()
    {
        $argument = [0];

        $this->expectException(AssertionException::class);

        $this->callStatic(Assert::class, $argument);
    }

    public function testNegativeOneThrows()
    {
        $argument = [-1];

        $this->expectException(AssertionException::class);

        $this->callStatic(Assert::class, $argument);
    }

    public function testStringNegativeOneWithAllowStringSetToTrueThrows()
    {
        $argument = ['-1', true];

        $this->expectException(AssertionException::class);

        $this->callStatic(Assert::class, $argument);
    }

    public function testNegativeInfinityThrows()
    {
        $argument = [-INF];

        $this->expectException(AssertionException::class);

        $this->callStatic(Assert::class, $argument);
    }

    public function testStringPositiveInfinityThrows()
    {
        $argument = ['INF'];

        $this->expectException(AssertionException::class);

        $this->callStatic(Assert::class, $argument);
    }

    #endregion
}
