<?php

namespace Fabs\Component\Assert;

class Assert
{
    /**
     * @param mixed $value
     * @param string $name
     */
    public static final function isNotNull($value, $name = null)
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
    public static final function isEquals($value, $expected, $name = null)
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
    public static final function isNotEquals($value, $expected, $name = null)
    {
        if ($value === $expected) {
            Assert::throwException($name, 'not-equals', 'equals'); // todo expectation and given should be more meaningful
        }
    }

    /**
     * @param string $value
     * @param string $name
     */
    public static final function isTypeExists($value, $name = null)
    {
        Assert::isString($value, $name);

        if (!class_exists($value) && !interface_exists($value)) {
            Assert::throwException($name, 'existing type name', $value);
        }
    }

    /**
     * @param string $value
     * @param string $name
     */
    public static final function isClassExists($value, $name = null)
    {
        Assert::isString($value, $name);

        if (!class_exists($value)) {
            Assert::throwException($name, 'existing class name', $value);
        }
    }

    /**
     * @param string $value
     * @param string $name
     */
    public static final function isInterfaceExists($value, $name = null)
    {
        Assert::isString($value, $name);

        if (!interface_exists($value)) {
            Assert::throwException($name, 'existing interface name', $value);
        }
    }

    #region type checkers

    /**
     * @param string $value
     * @param string $name
     * @throws AssertionExceptionInterface
     */
    public static final function isCallable($value, $name = null)
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
    public static final function isString($value, $name = null)
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
    public static final function isBoolean($value, $name = null)
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
    public static final function isInt($value, $name = null)
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
    public static final function isFloat($value, $name = null)
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
    public static final function isArray($value, $name = null)
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
    public static final function isType($value, $type, $name = null)
    {
        Assert::isTypePrivate($value, $type, $name, true);
    }

    /**
     * @param mixed $value
     * @param string $type
     * @param string $name
     * @param bool $use_child_class
     * @throws AssertionExceptionInterface
     */
    private static final function isTypePrivate($value, $type, $name, $use_child_class = false)
    {
        Assert::isString($type, 'type');

        if (!$value instanceof $type) {
            $given_type = static::getType($value);
            if ($use_child_class) {
                $exception = static::generateException($name, $type, $given_type);
                Assert::isTypePrivate($exception, AssertionExceptionInterface::class, 'exception');
            } else {
                $exception = self::generateException($name, $type, $given_type);
            }
            throw new $exception;
        }
    }

    /**
     * @param mixed $value
     * @param string[] $type_list
     * @param string $name
     * @throws AssertionExceptionInterface
     */
    public static final function isOneOfTypes($value, $type_list, $name = null)
    {
        Assert::isArray($type_list, 'type_list');

        foreach ($type_list as $type) {
            if ($value instanceof $type) {
                return;
            }
        }

        $given = static::getType($value);
        $expected = implode(" or ", $type_list);
        Assert::throwException($name, $expected, $given);
    }

    #endregion

    #region string operations

    /**
     * @param string $value
     * @param bool $accept_blanks
     * @param string $name
     * @throws AssertionExceptionInterface
     */
    public static final function isNotEmptyString($value, $accept_blanks = false, $name = null)
    {
        Assert::isString($value, $name);

        if (!$accept_blanks) {
            $value = trim($value);
        }

        if (strlen($value) === 0) {
            Assert::throwException($name, 'non empty', $value);
        }
    }

    /**
     * @param string $value
     * @param string $starts_with
     * @param string $name
     */
    public static final function startsWith($value, $starts_with, $name = null)
    {
        Assert::isString($starts_with, 'starts with');

        $escaped_starts_with = preg_quote($starts_with);
        $regex_pattern = "/^{$escaped_starts_with}/";
        self::isRegexMatches($value, $regex_pattern, $name);
    }

    /**
     * @param string $value
     * @param string $regex_pattern
     * @param string $name
     * @throws AssertionExceptionInterface
     */
    public static final function isRegexMatches($value, $regex_pattern, $name = null)
    {
        Assert::isString($value, $name);
        Assert::isRegexPattern($regex_pattern, 'regex pattern');

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
    public static final function isRegexPattern($value, $name = null)
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

    /**
     * @param string $value
     * @param string $name
     */
    public static final function isNotNullOrWhiteSpace($value, $name = null)
    {
        self::isNotEmptyString($value, false, $name);
    }

    #endregion

    #region array operations

    /**
     * @param array $value
     * @param string $name
     */
    public static final function isNotEmptyArray($value, $name = null)
    {
        Assert::isArray($value, $name);

        if (count($value) === 0) {
            Assert::throwException($name, 'non empty', Assert::getArrayAsString($value));
        }
    }

    /**
     * @param array $value
     * @param string $type
     * @param string $name
     */
    public static final function isArrayOfType($value, $type, $name = null)
    {
        Assert::isArray($value, $name);
        Assert::isClassExists($type, 'type');

        foreach ($value as $element) {
            Assert::isType($element, $type, $name);
        }
    }

    /**
     * @param array $value
     * @param bool $accept_empty
     * @param string $name
     */
    public static final function isSequentialArray($value, $accept_empty = true, $name = null)
    {
        if ($accept_empty !== true) {
            Assert::isNotEmptyArray($value, $name);
        } else {
            Assert::isArray($value, $name);
        }

        if (array_keys($value) !== range(0, count($value) - 1)) {
            Assert::throwException($name, 'sequential array', Assert::getArrayAsString($value));
        }
    }

    /**
     * @param array $array
     * @return string
     */
    private static final function getArrayAsString($array)
    {
        return var_export($array, true);
    }

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
     * @throws AssertionExceptionInterface
     */
    protected static final function throwException($name, $expected, $given)
    {
        $exception = static::generateException($name, $expected, $given);
        Assert::isTypePrivate($exception, AssertionExceptionInterface::class, 'exception');
        throw $exception;
    }
}