<?php

namespace Fabstract\Component\Assert\Test\PHPUnit\Assert;

use Fabstract\Component\Assert\Assert;
use Fabstract\Component\Assert\AssertionException;
use Fabstract\Component\Assert\Test\PHPUnit\ChildDummyClassThatExtendsDummyClass;
use Fabstract\Component\Assert\Test\PHPUnit\DummyClass;
use Fabstract\Component\Assert\Test\PHPUnit\DummyClassThatImplementsChildDummyInterface;
use Fabstract\Component\Assert\Test\PHPUnit\DummyClassThatImplementsDummyInterface;
use Fabstract\Component\Assert\Test\PHPUnit\DummyClassWithDummyTrait;
use Fabstract\Component\Assert\Test\PHPUnit\DummyInterface;
use Fabstract\Component\Assert\Test\PHPUnit\DummyTrait;
use Fabstract\Component\Assert\Test\PHPUnit\MethodTestBase;

class IsTypeMethodTest extends MethodTestBase
{

    #region correct arguments

    /**
     * @doesNotPerformAssertions
     */
    public function testExistingClassAndItsInstanceDoesNotThrow()
    {
        $argument = [new DummyClass(), DummyClass::class];

        $this->callStatic(Assert::class, $argument);
    }

    /**
     * @doesNotPerformAssertions
     */
    public function testChildClassInstanceAndParentClassDoesNotThrow()
    {
        $argument = [new ChildDummyClassThatExtendsDummyClass(), DummyClass::class];

        $this->callStatic(Assert::class, $argument);
    }

    /**
     * @doesNotPerformAssertions
     */
    public function tesClassInstanceThatImplementsChildInterfaceAndParentInterfaceDoesNotThrow()
    {
        $argument = [new DummyClassThatImplementsChildDummyInterface(), DummyInterface::class];

        $this->callStatic(Assert::class, $argument);
    }

    /**
     * @doesNotPerformAssertions
     */
    public function testExistingInterfaceAndItsInstanceDoesNotThrow()
    {
        $argument = [new DummyClassThatImplementsDummyInterface(), DummyInterface::class];

        $this->callStatic(Assert::class, $argument);
    }

    #endregion

    #region incorrect arguments

    public function testNullThrows()
    {
        $argument = [null, 'type'];

        $this->expectException(AssertionException::class);

        $this->callStatic(Assert::class, $argument);
    }

    public function testExistingTraitThrows()
    {
        $argument = [new DummyClassWithDummyTrait(), DummyTrait::class];

        $this->expectException(AssertionException::class);

        $this->callStatic(Assert::class, $argument);
    }

    #endregion
}
