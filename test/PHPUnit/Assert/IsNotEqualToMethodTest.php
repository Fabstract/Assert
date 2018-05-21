<?php

namespace Fabstract\Component\Assert\Test\PHPUnit\Assert;

use Fabstract\Component\Assert\Assert;
use Fabstract\Component\Assert\AssertionException;
use Fabstract\Component\Assert\Test\PHPUnit\DummyClass;
use Fabstract\Component\Assert\Test\PHPUnit\MethodTestBase;

class IsNotEqualToMethodTest extends MethodTestBase
{
    #region correct arguments

    /**
     * @doesNotPerformAssertions
     */
    public function testInstanceIsNotEqualToDifferentInstancesOfTheSameClass()
    {
        $instance1 = new DummyClass();
        $instance2 = new DummyClass();
        $arguments = [$instance1, $instance2];

        $this->callStatic(Assert::class, $arguments);
    }

    /**
     * @doesNotPerformAssertions
     */

    public function testStringZeroIsNotEqualToIntZero()
    {
        $arguments = ['0', 0];

        $this->callStatic(Assert::class, $arguments);
    }

    /**
     * @doesNotPerformAssertions
     */

    public function testFalseIsNotEqualToIntZero()
    {
        $arguments = [false, 0];

        $this->callStatic(Assert::class, $arguments);
    }

    /**
     * @doesNotPerformAssertions
     */

    public function testFalseIsNotEqualToNull()
    {
        $arguments = [false, null];

        $this->callStatic(Assert::class, $arguments);
    }

    /**
     * @doesNotPerformAssertions
     */
    public function testEmptyArrayIsNotEqualToNull()
    {
        $arguments = [[], null];

        $this->callStatic(Assert::class, $arguments);
    }

    /**
     * @doesNotPerformAssertions
     */
    public function testEmptyStringIsNotEqualToNull()
    {
        $arguments = ['', null];

        $this->callStatic(Assert::class, $arguments);
    }

    /**
     * @doesNotPerformAssertions
     */
    public function testIntZeroIsNotEqualToFloatZero()
    {
        $arguments = [0, 0.0];

        $this->callStatic(Assert::class, $arguments);
    }

    #endregion

    #region incorrect arguments

    public function testIntTwoEqualsIntTwo()
    {
        $arguments = [2, 2];

        $this->expectException(AssertionException::class);

        $this->callStatic(Assert::class, $arguments);
    }

    public function testStringTwoEqualsStringTwo()
    {
        $arguments = ['2', '2'];

        $this->expectException(AssertionException::class);

        $this->callStatic(Assert::class, $arguments);
    }

    public function testObjectEqualsToItself()
    {
        $instance = new DummyClass();
        $arguments = [$instance, $instance];

        $this->expectException(AssertionException::class);

        $this->callStatic(Assert::class, $arguments);
    }

    public function testPositiveINFIsEqualToPositiveINF()
    {
        $arguments = [INF, INF];

        $this->expectException(AssertionException::class);

        $this->callStatic(Assert::class, $arguments);
    }

    public function tesNullIsEqualToNull()
    {
        $arguments = [null, null];

        $this->expectException(AssertionException::class);

        $this->callStatic(Assert::class, $arguments);
    }

    public function tesEmptyArrayIsEqualToEmptyArray()
    {
        $arguments = [[], []];

        $this->expectException(AssertionException::class);

        $this->callStatic(Assert::class, $arguments);
    }

    public function tesEmptyStringIsEqualToEmptyString()
    {
        $arguments = ['', ''];

        $this->expectException(AssertionException::class);

        $this->callStatic(Assert::class, $arguments);
    }

    #endregion
}
