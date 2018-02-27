<?php


namespace Fabs\Component\Assert;


class Assert
{
    /**
     * @param mixed $value
     * @param string $name
     */
    public static final function assertNonNull($value, $name = null)
    {
        if ($value === null) {
            Assert::throwException($name, 'non-null', 'null');
        }
    }

    /**
     * @param mixed $value
     * @param mixed $expected
     * @param string $name
     */
    public static final function assertEquals($value, $expected, $name = null)
    {
        if ($value !== $expected) {
            Assert::throwException($name, 'equals', 'not-equals'); // todo expectation and given should be more meaningful
        }
    }

    /**
     * @param mixed $value
     * @param mixed $expected
     * @param string $name
     */
    public static final function assertNotEquals($value, $expected, $name = null)
    {
        if ($value === $expected) {
            Assert::throwException($name, 'not-equals', 'equals'); // todo expectation and given should be more meaningful
        }
    }

    /**
     * @param string $value
     * @param string $name
     */
    public static final function assertClassExists($value, $name = null)
    {
        Assert::assertString($value, $name);
        if (!class_exists($value)) {
            Assert::throwException($name, 'exist', 'not exist');
        }
    }

    #region type checkers

    /**
     * @param string $value
     * @param string $name
     * @throws AssertionExceptionInterface
     */
    public static final function assertCallable($value, $name = null)
    {
        if (!is_callable($value)) {
            $given_type = static::getType($value);
            Assert::throwException($name, 'callable', $given_type);
        }
    }

    /**
     * @param string $value
     * @param string $name
     * @throws AssertionExceptionInterface
     */
    public static final function assertString($value, $name = null)
    {
        if (!is_string($value)) {
            $given_type = static::getType($value);
            Assert::throwException($name, 'string', $given_type);
        }
    }

    /**
     * @param $value
     * @param null $name
     * @throws AssertionExceptionInterface
     */
    public static final function assertBoolean($value, $name = null)
    {
        if (!is_bool($value)) {
            $given_type = static::getType($value);
            Assert::throwException($name, 'boolean', $given_type);
        }
    }

    /**
     * @param int $value
     * @param string $name
     * @throws AssertionExceptionInterface
     */
    public static final function assertInt($value, $name = null)
    {
        if (is_int($value)) {
            $given_type = static::getType($value);
            Assert::throwException($name, 'int', $given_type);
        }
    }

    /**
     * @param float $value
     * @param string $name
     * @throws AssertionExceptionInterface
     */
    public static final function assertFloat($value, $name = null)
    {
        if (!is_float($value)) {
            $given_type = static::getType($value);
            Assert::throwException($name, 'float', $given_type);
        }
    }

    /**
     * @param array $value
     * @param string $name
     * @throws AssertionExceptionInterface
     */
    public static final function assertArray($value, $name = null)
    {
        if (!is_array($value)) {
            $given_type = static::getType($value);
            Assert::throwException($name, 'array', $given_type);
        }
    }

    /**
     * @param mixed $value
     * @param string $type
     * @param string $name
     * @throws AssertionExceptionInterface
     */
    public static final function assertType($value, $type, $name = null)
    {
        Assert::assertTypePrivate($value, $type, $name, true);
    }

    /**
     * @param mixed $value
     * @param string $type
     * @param string $name
     * @param bool $use_child_class
     * @throws AssertionExceptionInterface
     */
    private static final function assertTypePrivate($value, $type, $name, $use_child_class = false)
    {
        Assert::assertString($type, 'type');

        if (!$value instanceof $type) {
            $given_type = static::getType($value);
            if ($use_child_class) {
                $exception = static::generateException($name, $type, $given_type);
                Assert::assertTypePrivate($exception, AssertionExceptionInterface::class, 'exception');
            } else {
                $exception = self::generateException($name, $type, $given_type);
            }
            throw new $exception;
        }
    }

    #endregion

    #region string operations

    /**
     * @param string $value
     * @param bool $accept_blanks
     * @param string $name
     * @throws AssertionExceptionInterface
     */
    public static final function assertNonEmptyString($value, $accept_blanks = false, $name = null)
    {
        Assert::assertString($value, $name);

        if (!$accept_blanks) {
            $value = trim($value);
        }

        if (strlen($value) === 0) {
            Assert::throwException($name, 'non empty', $value);
        }
    }

    /**
     * @param string $value
     * @param string $regex_pattern
     * @param string $name
     * @throws AssertionExceptionInterface
     */
    public static final function assertRegexMatches($value, $regex_pattern, $name = null)
    {
        Assert::assertString($value, $name);
        Assert::assertRegexPattern($regex_pattern, 'regex pattern');

        if (preg_match($regex_pattern, $value) !== 1) {
            Assert::throwException($name, $regex_pattern, $value);
        }
    }

    /**
     * @param string $value
     * @param string $name
     * @throws AssertionExceptionInterface
     *
     */
    public static final function assertRegexPattern($value, $name = null)
    {
        if (Assert::isRegex($value) !== true) {
            Assert::throwException($name, 'regex', $value);
        }
    }

    /**
     * @param string $value
     * @return bool
     */
    private static final function isRegex($value)
    {
        set_error_handler(
            function () {
            },
            E_WARNING
        );
        $is_valid_regex_pattern = preg_match($value, "") !== false;
        restore_error_handler();

        return $is_valid_regex_pattern;
    }

    #endregion

    #region array operations
    // todo
    #endregion

    /**
     * @param string $name
     * @param string $expected
     * @param string $given
     * @return AssertionExceptionInterface
     */
    protected static function generateException($name, $expected, $given)
    {
        if (!is_string($name)) {
            $message_template = 'Variable is expected to be %s, given %s (no name was provided).';
            $message = sprintf($message_template, $expected, $given);
        } else {
            $message_template = 'Variable with name "%s" is expected to be %s, given %s.';
            $message = sprintf($message_template, $name, $expected, $given);
        }

        return new AssertionException($message);
    }

    /**
     * @param mixed $value
     * @return string
     */
    protected static final function getType($value)
    {
        if (is_object($value)) {
            return get_class($value);
        }

        if (is_resource($value)) {
            return get_resource_type($value);
        }

        return gettype($value);
    }

    /**
     * @param string $name
     * @param string $expected
     * @param $given
     */
    protected static final function throwException($name, $expected, $given)
    {
        $exception = static::generateException($name, $expected, $given);
        Assert::assertTypePrivate($exception, AssertionExceptionInterface::class, 'exception');
        throw $exception;
    }
}