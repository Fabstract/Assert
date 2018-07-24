<?php

namespace Fabstract\Component\Assert\Test\PHPUnit\Assert;

use Fabstract\Component\Assert\Assert;
use Fabstract\Component\Assert\AssertionException;
use Fabstract\Component\Assert\Test\PHPUnit\MethodTestBase;

/**
 * Class IsRegexMatchesMethodTest
 * @package Fabstract\Component\Assert\Test\PHPUnit\Assert
 *
 * @see \Fabstract\Component\Assert\Assert::isRegexMatches()
 */
class IsRegexMatchesMethodTest extends MethodTestBase
{

    #region correct arguments

    /**
     * @doesNotPerformAssertions
     */
    public function testOnlyLowercaseWordStringWithLowercaseWordRegexDoesNotThrow()
    {
        $argument = ['only_word_string', '/^\w+$/'];

        $this->callStatic(Assert::class, $argument);
    }

    /**
     * @doesNotPerformAssertions
     */
    public function testEmptyStringWithAnyCharacterRegexDoesNotThrow()
    {
        $argument = ['', '/.*/'];

        $this->callStatic(Assert::class, $argument);
    }

    /**
     * @doesNotPerformAssertions
     */
    public function testEmptyRegexDoesNotThrow()
    {
        $argument = ['some string', '//'];

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

    public function testInvalidRegexThrows()
    {
        $argument = ['some string', '/not_a_regex_string'];

        $this->expectException(AssertionException::class);

        $this->callStatic(Assert::class, $argument);
    }

    public function testNonStringRegexArgumentThrows()
    {
        $argument = ['some string', 123];

        $this->expectException(AssertionException::class);

        $this->callStatic(Assert::class, $argument);
    }

    #endregion
}
