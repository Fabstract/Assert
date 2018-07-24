<?php

namespace Fabstract\Component\Assert\Test\PHPUnit\Assert;

use Fabstract\Component\Assert\Assert;
use Fabstract\Component\Assert\AssertionException;
use Fabstract\Component\Assert\Test\PHPUnit\DummyClassThatImplementsDummyInterface;
use Fabstract\Component\Assert\Test\PHPUnit\DummyInterface;
use Fabstract\Component\Assert\Test\PHPUnit\MethodTestBase;

/**
 * Class IsImplementsMethodTest
 * @package Fabstract\Component\Assert\Test\PHPUnit\Assert
 *
 * @see \Fabstract\Component\Assert\Assert::isImplements()
 */
class IsImplementsMethodTest extends MethodTestBase
{

    #region correct arguments

    /**
     * @doesNotPerformAssertions
     */
    public function testObjectAndItsInterfaceDoesNotThrow()
    {
        $argument = [new DummyClassThatImplementsDummyInterface(), DummyInterface::class];

        $this->callStatic(Assert::class, $argument);
    }

    /**
     * @doesNotPerformAssertions
     */
    public function testClassNameAndItsInterfaceDoesNotThrow()
    {
        $argument = [DummyClassThatImplementsDummyInterface::class, DummyInterface::class];

        $this->callStatic(Assert::class, $argument);
    }

    #endregion

    #region incorrect arguments

    public function testClassInsteadOfInterfaceThrows()
    {
        $argument = [new DummyClassThatImplementsDummyInterface(), DummyClassThatImplementsDummyInterface::class];

        $this->expectException(AssertionException::class);

        $this->callStatic(Assert::class, $argument);
    }

    public function testNullThrows()
    {
        $argument = [null, DummyClassThatImplementsDummyInterface::class];

        $this->expectException(AssertionException::class);

        $this->callStatic(Assert::class, $argument);
    }

    #endregion
}
