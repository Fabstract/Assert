<?php

namespace Fabstract\Component\Assert\Test\PHPUnit\Assert;

use Fabstract\Component\Assert\Assert;
use Fabstract\Component\Assert\AssertionException;
use Fabstract\Component\Assert\Test\PHPUnit\ChildDummyClassThatExtendsDummyClass;
use Fabstract\Component\Assert\Test\PHPUnit\ChildDummyInterfaceThatExtendsDummyInterface;
use Fabstract\Component\Assert\Test\PHPUnit\DummyClass;
use Fabstract\Component\Assert\Test\PHPUnit\DummyClassThatImplementsDummyInterface;
use Fabstract\Component\Assert\Test\PHPUnit\DummyInterface;
use Fabstract\Component\UnitTest\MethodTestBase;

/**
 * Class IsChildOfMethodTest
 * @package Fabstract\Component\Assert\Test\PHPUnit\Assert
 *
 * @see \Fabstract\Component\Assert\Assert::isChildOf()
 */
class IsChildOfMethodTest extends MethodTestBase
{

    #region correct arguments

    /**
     * @doesNotPerformAssertions
     */
    public function testClassAndItsChildClassInstanceDoesNotThrow()
    {
        $argument = [new ChildDummyClassThatExtendsDummyClass(), DummyClass::class];

        $this->callStatic(Assert::class, $argument);
    }

    /**
     * @doesNotPerformAssertions
     */
    public function testClassInstanceAndItsInterfaceDoesNotThrow()
    {
        $argument = [new DummyClassThatImplementsDummyInterface(), DummyInterface::class];

        $this->callStatic(Assert::class, $argument);
    }

    /**
     * @doesNotPerformAssertions
     */
    public function testChildInterfaceAndParentInterfaceDoesNotThrow()
    {
        $argument = [ChildDummyInterfaceThatExtendsDummyInterface::class, DummyInterface::class];

        $this->callStatic(Assert::class, $argument);
    }

    #endregion

    #region incorrect arguments

    public function testNullThrows()
    {
        $argument = [null, DummyInterface::class];

        $this->expectException(AssertionException::class);

        $this->callStatic(Assert::class, $argument);
    }

    #region incorrect arguments

    public function testTheSameClassThrows()
    {
        $argument = [new DummyClass(), DummyClass::class];

        $this->expectException(AssertionException::class);

        $this->callStatic(Assert::class, $argument);
    }

    #endregion
}
