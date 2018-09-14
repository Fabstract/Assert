<?php

namespace Fabstract\Component\Assert\Test\PHPUnit\Assert;

use Fabstract\Component\Assert\Assert;
use Fabstract\Component\Assert\AssertionException;
use Fabstract\Component\Assert\Test\PHPUnit\DummyClass;
use Fabstract\Component\UnitTest\MethodTestBase;

/**
 * Class IsCallableMethodTest
 * @package Fabstract\Component\Assert\Test\PHPUnit\Assert
 *
 * @see \Fabstract\Component\Assert\Assert::isCallable()
 */
class IsCallableMethodTest extends MethodTestBase
{

    #region correct arguments

    /**
     * @doesNotPerformAssertions
     */
    public function testClosureDoesNotThrow()
    {
        $closure = function () {
        };
        $argument = [$closure];

        $this->callStatic(Assert::class, $argument);
    }

    /**
     * @doesNotPerformAssertions
     */
    public function testObjectPublicMethodDoesNotThrow()
    {
        $argument = [[new DummyClass(), 'publicDummyFunction']];

        $this->callStatic(Assert::class, $argument);
    }

    /**
     * @doesNotPerformAssertions
     */
    public function testClassNamePublicMethodDoesNotThrow()
    {
        $argument = [[DummyClass::class, 'publicDummyFunction']];

        $this->callStatic(Assert::class, $argument);
    }

    /**
     * @doesNotPerformAssertions
     */
    public function testClassNamePublicStaticMethodDoesNotThrow()
    {
        $argument = [[DummyClass::class, 'publicStaticDummyFunction']];

        $this->callStatic(Assert::class, $argument);
    }

    /**
     * @doesNotPerformAssertions
     */
    public function testCallableNameDoesNotThrow()
    {
        $argument = ['str_replace'];

        $this->callStatic(Assert::class, $argument);
    }

    #endregion

    #region incorrect arguments

    public function testNotACallableNameThrows()
    {
        $argument = ['nonexistingcallablename'];
        $this->expectException(AssertionException::class);

        $this->callStatic(Assert::class, $argument);
    }

    public function testNullThrows()
    {
        $argument = [null];
        $this->expectException(AssertionException::class);

        $this->callStatic(Assert::class, $argument);
    }

    public function testObjectProtectedMethodThrows()
    {
        $argument = [[new DummyClass(), 'protectedDummyFunction']];
        $this->expectException(AssertionException::class);

        $this->callStatic(Assert::class, $argument);
    }

    public function testObjectProtectedStaticMethodThrows()
    {
        $argument = [[new DummyClass(), 'protectedStaticDummyFunction']];
        $this->expectException(AssertionException::class);

        $this->callStatic(Assert::class, $argument);
    }

    public function testObjectPrivateMethodThrows()
    {
        $argument = [[new DummyClass(), 'privateDummyFunction']];
        $this->expectException(AssertionException::class);

        $this->callStatic(Assert::class, $argument);
    }

    public function testObjectPrivateStaticMethodThrows()
    {
        $argument = [[new DummyClass(), 'privateStaticDummyFunction']];
        $this->expectException(AssertionException::class);

        $this->callStatic(Assert::class, $argument);
    }

    #endregion
}
