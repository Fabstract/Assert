<?php

namespace Fabstract\Component\Assert\Test\PHPUnit\Assert;

use Fabstract\Component\Assert\Assert;
use Fabstract\Component\Assert\AssertionException;
use Fabstract\Component\Assert\Test\PHPUnit\MethodTestBase;

class IsNumericMethodTest extends MethodTestBase
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

    /**
     * @doesNotPerformAssertions
     */
    public function testIntOneDoesNotThrow()
    {
        $argument = [1];

        $this->callStatic(Assert::class, $argument);
    }

    /**
     * @doesNotPerformAssertions
     */
    public function testIntZeroDoesNotThrow()
    {
        $argument = [0];

        $this->callStatic(Assert::class, $argument);
    }

    /**
     * @doesNotPerformAssertions
     */
    public function testIntNegativeOneDoesNotThrow()
    {
        $argument = [-1];

        $this->callStatic(Assert::class, $argument);
    }

    /**
     * @doesNotPerformAssertions
     */
    public function testPHPIntMaxDoesNotThrow()
    {
        $argument = [PHP_INT_MAX];

        $this->callStatic(Assert::class, $argument);
    }

    /**
     * @doesNotPerformAssertions
     */
    public function testPHPIntMinDoesNotThrow()
    {
        $argument = [PHP_INT_MIN];

        $this->callStatic(Assert::class, $argument);
    }

    /**
     * @doesNotPerformAssertions
     */
    public function testStringZeroDoesNotThrow()
    {
        $argument = ['0'];

        $this->callStatic(Assert::class, $argument);
    }

    /**
     * @doesNotPerformAssertions
     */
    public function testStringPointFiveDoesNotThrow()
    {
        $argument = ['0.5'];

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

    public function testNonNumericStringThrows()
    {
        $argument = ['some string'];

        $this->expectException(AssertionException::class);

        $this->callStatic(Assert::class, $argument);
    }

    public function testBooleanTrueThrows()
    {
        $argument = [true];

        $this->expectException(AssertionException::class);

        $this->callStatic(Assert::class, $argument);
    }

    public function testBooleanFalseThrows()
    {
        $argument = [false];

        $this->expectException(AssertionException::class);

        $this->callStatic(Assert::class, $argument);
    }

    #endregion
}
