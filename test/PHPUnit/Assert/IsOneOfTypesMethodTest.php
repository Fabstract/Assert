<?php

namespace Fabstract\Component\Assert\Test\PHPUnit\Assert;

use Fabstract\Component\Assert\Assert;
use Fabstract\Component\Assert\AssertionException;
use Fabstract\Component\Assert\Test\PHPUnit\DummyClass;
use Fabstract\Component\UnitTest\MethodTestBase;

class IsOneOfTypesMethodTest extends MethodTestBase
{

    #region correct arguments

    /**
     * @doesNotPerformAssertions
     */
    public function testObjectAndItsClassDoesNotThrow()
    {
        $argument = [new DummyClass(), [DummyClass::class]];

        $this->callStatic(Assert::class, $argument);
    }

    #endregion

    #region incorrect arguments

    public function testNullThrows()
    {
        $argument = [null, [DummyClass::class]];

        $this->expectException(AssertionException::class);

        $this->callStatic(Assert::class, $argument);
    }

    public function testEmptyTypeListThrows()
    {
        $argument = [new DummyClass(), []];

        $this->expectException(AssertionException::class);

        $this->callStatic(Assert::class, $argument);
    }

    #endregion
}
