<?php

namespace Fabstract\Component\Assert\Test\PHPUnit\Assert;

use Fabstract\Component\Assert\Assert;
use Fabstract\Component\Assert\AssertionException;
use Fabstract\Component\Assert\Test\PHPUnit\MethodTestBase;

/**
 * Class IsRegexMethodTest
 * @package Fabstract\Component\Assert\Test\PHPUnit\Assert
 *
 * @see \Fabstract\Component\Assert\Assert::isRegex()
 */
class IsRegexMethodTest extends MethodTestBase
{

    #region correct arguments

    public function testEmptyRegexReturnsTrue()
    {
        $argument = ['//'];

        $result = $this->callStatic(Assert::class, $argument);
        $this->assertEquals(true, $result);
    }

    public function testAnyCharacterRegexPatternReturnsTrue()
    {
        $argument = ['/./'];

        $result = $this->callStatic(Assert::class, $argument);
        $this->assertEquals(true, $result);
    }

    #endregion

    #region incorrect arguments

    public function testNullReturnsFalse()
    {
        $argument = [null];

        $result = $this->callStatic(Assert::class, $argument);
        $this->assertEquals(false, $result);
    }

    public function testNonStringArgumentReturnsFalse()
    {
        $argument = [1];

        $result = $this->callStatic(Assert::class, $argument);
        $this->assertEquals(false, $result);
    }

    public function testStringWithoutSlashesReturnsFalse()
    {
        $argument = ['string without slashes'];

        $result = $this->callStatic(Assert::class, $argument);
        $this->assertEquals(false, $result);
    }

    #endregion
}
