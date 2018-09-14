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

class IsArrayOfTypeMethodTest extends MethodTestBase
{

    #region correct arguments

    /**
     * @doesNotPerformAssertions
     */
    public function testEmptyArrayWithExistingTypeDoesNotThrow()
    {
        $argument = [[], DummyClass::class];

        $this->callStatic(Assert::class, $argument);
    }

    /**
     * @doesNotPerformAssertions
     */
    public function testInstanceArrayWithExistingTypeDoesNotThrow()
    {
        $argument = [[new DummyClass()], DummyClass::class];

        $this->callStatic(Assert::class, $argument);
    }

    /**
     * @doesNotPerformAssertions
     */
    public function testInstanceArrayWithInterfaceDoesNotThrow()
    {
        $argument = [[new DummyClassThatImplementsDummyInterface()], DummyInterface::class];

        $this->callStatic(Assert::class, $argument);
    }

    #endregion

    #region incorrect arguments

    public function testNullThrows()
    {
        $argument = [null, null];

        $this->expectException(AssertionException::class);

        $this->callStatic(Assert::class, $argument);
    }

    public function testNonExistingTypeThrows()
    {
        $argument = [[], 'nonexistingtype'];

        $this->expectException(AssertionException::class);

        $this->callStatic(Assert::class, $argument);
    }

    public function testNonEmptyArrayWithWrongTypeThrows()
    {
        $argument = [[new DummyClass()], DummyInterface::class];

        $this->expectException(AssertionException::class);

        $this->callStatic(Assert::class, $argument);
    }

    public function testClassWithTraitThrows()
    {
        $argument = [[new DummyClassWithDummyTrait()], DummyTrait::class];

        $this->expectException(AssertionException::class);

        $this->callStatic(Assert::class, $argument);
    }

    #endregion
}
