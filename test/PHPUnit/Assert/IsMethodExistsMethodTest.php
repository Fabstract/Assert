<?php

namespace Fabstract\Component\Assert\Test\PHPUnit\Assert;

use Fabstract\Component\Assert\Assert;
use Fabstract\Component\Assert\AssertionException;
use Fabstract\Component\Assert\Test\PHPUnit\DummyClass;
use Fabstract\Component\Assert\Test\PHPUnit\DummyClassWithDummyTrait;
use Fabstract\Component\Assert\Test\PHPUnit\DummyInterface;
use Fabstract\Component\Assert\Test\PHPUnit\DummyTrait;
use Fabstract\Component\Assert\Test\PHPUnit\MethodTestBase;

class IsMethodExistsMethodTest extends MethodTestBase
{

    #region correct arguments

    /**
     * @doesNotPerformAssertions
     */
    public function testClassAndPublicMethodDoesNotThrow()
    {
        $arguments = [DummyClass::class, 'publicDummyFunction'];

        $this->callStatic(Assert::class, $arguments);
    }

    /**
     * @doesNotPerformAssertions
     */
    public function testClassAndProtectedMethodDoesNotThrow()
    {
        $arguments = [DummyClass::class, 'protectedDummyFunction'];

        $this->callStatic(Assert::class, $arguments);
    }

    /**
     * @doesNotPerformAssertions
     */
    public function testClassAndPrivateMethodDoesNotThrow()
    {
        $arguments = [DummyClass::class, 'privateDummyFunction'];

        $this->callStatic(Assert::class, $arguments);
    }

    /**
     * @doesNotPerformAssertions
     */
    public function testClassAndPrivateStaticMethodDoesNotThrow()
    {
        $arguments = [DummyClass::class, 'privateStaticDummyFunction'];

        $this->callStatic(Assert::class, $arguments);
    }

    /**
     * @doesNotPerformAssertions
     */
    public function testObjectAndPrivateStaticMethodDoesNotThrow()
    {
        $arguments = [new DummyClass(), 'privateStaticDummyFunction'];

        $this->callStatic(Assert::class, $arguments);
    }

    /**
     * @doesNotPerformAssertions
     */
    public function testInterfaceAndMethodDoesNotThrow()
    {
        $arguments = [DummyInterface::class, 'dummyMethod'];

        $this->callStatic(Assert::class, $arguments);
    }

    /**
     * @doesNotPerformAssertions
     */
    public function testClassWithTraitAndTraitMethodDoesNotThrow()
    {
        $arguments = [DummyClassWithDummyTrait::class, 'dummyFunction'];

        $this->callStatic(Assert::class, $arguments);
    }

    #endregion

    #region incorrect arguments

    public function testNonExistingClassThrows()
    {
        $arguments = ['nonexistingclassname', 'dummyFunction'];

        $this->expectException(AssertionException::class);

        $this->callStatic(Assert::class, $arguments);
    }

    public function testClassWithNonExistingMethodThrows()
    {
        $arguments = [DummyClass::class, 'nonexistingmethodname'];

        $this->expectException(AssertionException::class);

        $this->callStatic(Assert::class, $arguments);
    }

    public function testTraitAndMethodThrows()
    {
        $arguments = [DummyTrait::class, 'dummyFunction'];

        $this->expectException(AssertionException::class);

        $this->callStatic(Assert::class, $arguments);
    }

    #endregion
}
