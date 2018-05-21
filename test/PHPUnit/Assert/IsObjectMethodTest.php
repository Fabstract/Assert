<?php

namespace Fabstract\Component\Assert\Test\PHPUnit\Assert;

use Fabstract\Component\Assert\Assert;
use Fabstract\Component\Assert\AssertionException;
use Fabstract\Component\Assert\Test\PHPUnit\DummyClass;
use Fabstract\Component\Assert\Test\PHPUnit\MethodTestBase;

class IsObjectMethodTest extends MethodTestBase
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

    #endregion

    #region incorrect arguments

    public function testNullThrows()
    {
        $argument = null;
        $this->expectException(AssertionException::class);

        $this->callStatic(Assert::class, [$argument]);
    }

    public function testIntThrows()
    {
        $argument = 1;
        $this->expectException(AssertionException::class);

        $this->callStatic(Assert::class, [$argument]);
    }

    #endregion
}
