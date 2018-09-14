<?php

namespace Fabstract\Component\Assert\Test\PHPUnit\Assert;

use Fabstract\Component\Assert\Assert;
use Fabstract\Component\Assert\AssertionException;
use Fabstract\Component\UnitTest\MethodTestBase;

class IsInArrayMethodTest extends MethodTestBase
{
    #region correct arguments

    /**
     * @doesNotPerformAssertions
     */
    public function testFirstElementOfTheArrayDoesNotThrow()
    {
        $array = ['element'];
        $argument = [$array[0], $array];

        $this->callStatic(Assert::class, $argument);
    }

    #endregion

    #region incorrect arguments

    public function testNonArrayArgumentThrows()
    {
        $argument = [null, null];

        $this->expectException(AssertionException::class);

        $this->callStatic(Assert::class, $argument);
    }

    #endregion
}
