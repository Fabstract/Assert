<?php

namespace Fabstract\Component\Assert\Test\PHPUnit\Assert;

use Fabstract\Component\Assert\Assert;
use Fabstract\Component\Assert\AssertionException;
use Fabstract\Component\Assert\Test\PHPUnit\DummyClass;
use Fabstract\Component\Assert\Test\PHPUnit\DummyClassThatImplementsDummyInterface;
use Fabstract\Component\Assert\Test\PHPUnit\DummyClassWithDummyTrait;
use Fabstract\Component\Assert\Test\PHPUnit\DummyInterface;
use Fabstract\Component\Assert\Test\PHPUnit\DummyTrait;
use Fabstract\Component\UnitTest\MethodTestBase;

class IsInstanceOfMethodTest extends MethodTestBase
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
