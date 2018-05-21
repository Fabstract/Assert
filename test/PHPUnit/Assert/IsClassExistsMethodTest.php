<?php

namespace Fabstract\Component\Assert\Test\PHPUnit\Assert;

use Fabstract\Component\Assert\Assert;
use Fabstract\Component\Assert\AssertionException;
use Fabstract\Component\Assert\Test\PHPUnit\DummyClass;
use Fabstract\Component\Assert\Test\PHPUnit\DummyInterface;
use Fabstract\Component\Assert\Test\PHPUnit\DummyTrait;
use Fabstract\Component\Assert\Test\PHPUnit\MethodTestBase;

class IsClassExistsMethodTest extends MethodTestBase
{

    #region correct arguments

    /**
     * @doesNotPerformAssertions
     */
    public function testExistingClassDoesNotThrow()
    {
        $argument = [DummyClass::class];

        $this->callStatic(Assert::class, $argument);
    }

    #endregion

    #region incorrect arguments

    public function testNonExistingClassThrows()
    {
        $argument = ['nonexistingclassname'];

        $this->expectException(AssertionException::class);

        $this->callStatic(Assert::class, $argument);
    }

    public function testExistingInterfaceThrows()
    {
        $argument = [DummyInterface::class];

        $this->expectException(AssertionException::class);

        $this->callStatic(Assert::class, $argument);
    }

    public function testExistingTraitThrows()
    {
        $argument = [DummyTrait::class];

        $this->expectException(AssertionException::class);

        $this->callStatic(Assert::class, $argument);
    }

    #endregion
}
