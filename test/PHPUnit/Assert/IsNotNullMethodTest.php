<?php

namespace Fabstract\Component\Assert\Test\PHPUnit\Assert;

use Fabstract\Component\Assert\Assert;
use Fabstract\Component\Assert\AssertionException;
use Fabstract\Component\Assert\Test\PHPUnit\DummyClass;
use Fabstract\Component\UnitTest\MethodTestBase;

class IsNotNullMethodTest extends MethodTestBase
{
    #region correct arguments

    /**
     * @doesNotPerformAssertions
     */
    public function testStdClassDoesNotThrow()
    {
        $argument = new \stdClass();

        $this->callStatic(Assert::class, [$argument]);
    }

    /**
     * @doesNotPerformAssertions
     */
    public function testClassInstanceDoesNotThrow()
    {
        $argument = new DummyClass();

        $this->callStatic(Assert::class, [$argument]);
    }

    /**
     * @doesNotPerformAssertions
     */
    public function testClosureDoesNotThrow()
    {
        $argument = function () {
        };

        $this->callStatic(Assert::class, [$argument]);
    }

    /**
     * @doesNotPerformAssertions
     */
    public function testIntZeroDoesNotThrow()
    {
        $argument = 0;

        $this->callStatic(Assert::class, [$argument]);
    }

    /**
     * @doesNotPerformAssertions
     */
    public function testFloatZeroDoesNotThrow()
    {
        $argument = 0.0;

        $this->callStatic(Assert::class, [$argument]);
    }

    /**
     * @doesNotPerformAssertions
     */
    public function testFalseDoesNotThrow()
    {
        $argument = false;

        $this->callStatic(Assert::class, [$argument]);
    }

    /**
     * @doesNotPerformAssertions
     */
    public function testStringWithValueNullDoesNotThrow()
    {
        $argument = 'null';

        $this->callStatic(Assert::class, [$argument]);
    }

    /**
     * @doesNotPerformAssertions
     */
    public function testArrayDoesNotThrow()
    {
        $argument = [];

        $this->callStatic(Assert::class, [$argument]);
    }

    /**
     * @doesNotPerformAssertions
     */
    public function testClassDoesNotThrow()
    {
        $argument = Assert::class;

        $this->callStatic(Assert::class, [$argument]);
    }

    #endregion

    #region incorrect arguments

    public function testNullThrows()
    {
        $argument = null;
        $this->expectException(AssertionException::class);

        $this->callStatic(Assert::class, [$argument]);
    }

    #endregion
}
