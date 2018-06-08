<?php

/** @noinspection PhpDocMissingThrowsInspection */

/** @noinspection PhpUnhandledExceptionInspection */

namespace Fabstract\Component\Assert;

class Assert
{
    #region general operations

    /**
     * @param mixed $value
     * @param string $name
     */
    public static final function isObject($value, $name = null)
    {
        if (is_object($value) !== true) {
            $given_type = static::getType($value);
            static::throwException($name, 'object', $given_type);
        }
    }

    /**
     * @param mixed $value
     * @param string $name
     */
    public static final function isNotNull($value, $name = null)
    {
        if ($value === null) {
            static::throwException($name, 'non-null', 'null');
        }
    }

    /**
     * @param mixed $value
     * @param mixed $expected
     * @param string $name
     *
     * @deprecated 0.2 Use isEqualTo instead
     * @see Assert::isEqualTo()
     */
    public static final function isEquals($value, $expected, $name = null)
    {
        static::isEqualTo($value, $expected, $name);
    }

    /**
     * @param mixed $value
     * @param mixed $expected
     * @param string $name
     */
    public static final function isEqualTo($value, $expected, $name = null)
    {
        if ($value !== $expected) {
            static::throwException($name, 'equals', 'not-equals'); // todo expectation and given should be more meaningful
        }
    }

    /**
     * @param mixed $value
     * @param mixed $expected
     * @param string $name
     *
     * @deprecated 0.2 Use isNotEqualTo
     * @see Assert::isNotEqualTo()
     */
    public static final function isNotEquals($value, $expected, $name = null)
    {
        static::isNotEqualTo($value, $expected, $name);
    }

    /**
     * @param mixed $value
     * @param mixed $expected
     * @param string $name
     */
    public static final function isNotEqualTo($value, $expected, $name = null)
    {
        if ($value === $expected) {
            static::throwException($name, 'not-equals', 'equals'); // todo expectation and given should be more meaningful
        }
    }

    /**
     * @param string $value
     * @param string $name
     */
    public static final function isTypeExists($value, $name = null)
    {
        static::isString($value, $name);

        if (!class_exists($value) && !interface_exists($value)) {
            static::throwException($name, 'existing type name', $value);
        }
    }

    /**
     * @param string $value
     * @param string $name
     */
    public static final function isClassExists($value, $name = null)
    {
        static::isString($value, $name);

        if (!class_exists($value)) {
            static::throwException($name, 'existing class name', $value);
        }
    }

    /**
     * @param string $value
     * @param string $name
     */
    public static final function isInterfaceExists($value, $name = null)
    {
        static::isString($value, $name);

        if (!interface_exists($value)) {
            static::throwException($name, 'existing interface name', $value);
        }
    }

    /**
     * @param object|string $object_or_class_name
     * @param string $method
     * @param null $name
     */
    public static final function isMethodExists($object_or_class_name, $method, $name = null)
    {
        if (is_string($object_or_class_name) === true) {
            static::isTypeExists($object_or_class_name);
            $name = $object_or_class_name;
        } elseif (is_object($object_or_class_name)) {
            $name = get_class($object_or_class_name);
        } else {
            $given_type = gettype($object_or_class_name);
            static::throwException($name, 'object or class name', $given_type);
        }

        static::isString($method);

        if (method_exists($object_or_class_name, $method) !== true) {
            $expected = "contain method {$method}";
            static::throwException($name, $expected, 'not found');
        }
    }

    /**
     * @param mixed $value
     * @param mixed[] $allowed_value_list
     * @param bool $type_strict
     * @param string $name
     */
    public static final function isInArray($value, $allowed_value_list, $type_strict = false, $name = null)
    {
        static::isArray($allowed_value_list, 'allowed_value_list');

        if (in_array($value, $allowed_value_list, $type_strict) !== true) {
            static::throwException($name, 'one of allowed_value_list', 'not in allowed_value_list');
        }
    }

    #endregion

    #region type checkers

    /**
     * @param string $value
     * @param string $name
     */
    public static final function isCallable($value, $name = null)
    {
        if (!is_callable($value)) {
            $given_type = static::getType($value);
            static::throwException($name, 'callable', $given_type);
        }
    }

    /**
     * @param string $value
     * @param string $name
     */
    public static final function isString($value, $name = null)
    {
        if (!is_string($value)) {
            $given_type = static::getType($value);
            static::throwException($name, 'string', $given_type);
        }
    }

    /**
     * @param $value
     * @param string $name
     */
    public static final function isBoolean($value, $name = null)
    {
        if (!is_bool($value)) {
            $given_type = static::getType($value);
            static::throwException($name, 'boolean', $given_type);
        }
    }

    /**
     * @param int $value
     * @param string $name
     */
    public static final function isInt($value, $name = null)
    {
        if (!is_int($value)) {
            $given_type = static::getType($value);
            static::throwException($name, 'int', $given_type);
        }
    }

    /**
     * Useful for checking if value can be used as index in arrays.
     *
     * @param int|string $value
     * @param string $name
     * @author AssertionExceptionInterface
     */
    public static final function isStringOrInt($value, $name = null) // todo test
    {
        if (!is_string($value) && !is_int($value)) {
            $given_type = static::getType($value);
            static::throwException($name, 'string or int', $given_type);
        }
    }

    /**
     * Useful for checking whether the value is int or float
     *
     * @param int|float $value
     * @param string $name
     * @author AssertionExceptionInterface
     */
    public static final function isIntOrFloat($value, $name = null) // todo test
    {
        if (!is_int($value) && !is_float($value)) {
            $given_type = static::getType($value);
            static::throwException($name, 'int or float', $given_type);
        }
    }

    /**
     * @param float $value
     * @param string $name
     */
    public static final function isFloat($value, $name = null)
    {
        if (!is_float($value)) {
            $given_type = static::getType($value);
            static::throwException($name, 'float', $given_type);
        }
    }

    /**
     * @param array $value
     * @param string $name
     */
    public static final function isArray($value, $name = null)
    {
        if (!is_array($value)) {
            $given_type = static::getType($value);
            static::throwException($name, 'array', $given_type);
        }
    }

    /**
     * @param string|int|float $value
     * @param string $name
     */
    public static final function isNumeric($value, $name = null)
    {
        if (!is_numeric($value)) {
            $given_type = static::getType($value);
            static::throwException($name, 'numeric', $given_type);
        }
    }

    /**
     * @param mixed $value
     * @param string $type
     * @param string $name
     */
    public static final function isType($value, $type, $name = null)
    {
        static::isTypePrivate($value, $type, $name, true);
    }

    /**
     * @param mixed $value
     * @param string $type
     * @param string $name
     * @param bool $use_child_class
     */
    private static final function isTypePrivate($value, $type, $name, $use_child_class = false)
    {
        static::isString($type, 'type');

        if (is_string($value)) {
            static::isNotNullOrWhiteSpace($value, $name);
            $given_type = static::getType($value);
            if (is_a($value, $type, true) !== true) {
                static::throwException($name, $type, $given_type, $use_child_class);
            }
        } elseif (!$value instanceof $type) {
            $given_type = static::getType($value);
            static::throwException($name, $type, $given_type, $use_child_class);
        }
    }

    /**
     * @param mixed $value
     * @param string[] $type_list
     * @param string $name
     */
    public static final function isOneOfTypes($value, $type_list, $name = null)
    {
        static::isArray($type_list, 'type_list');

        foreach ($type_list as $type) {
            if ($value instanceof $type) {
                return;
            }
        }

        $given = static::getType($value);
        $expected = implode(" or ", $type_list);
        static::throwException($name, $expected, $given);
    }

    /**
     * @param string|object $value
     * @param string $interface
     * @param string $name
     */
    public static final function isImplements($value, $interface, $name = null)
    {
        if (is_string($value)) {
            static::isClassExists($value, $name);
            $given = $value;
        } else {
            static::isObject($value, $name);
            $given = static::getType($value);
        }

        static::isInterfaceExists($interface, 'interface');

        if (is_subclass_of($value, $interface) !== true) {
            static::throwException($name, $interface, $given);
        }
    }

    /**
     * @param string|object $value
     * @param string $parent
     * @param string $name
     */
    public static final function isChildOf($value, $parent, $name = null)
    {
        if (is_string($value)) {
            $given = $value;
            if (class_exists($value)) {
                static::isClassExists($parent, 'parent');
            } elseif (interface_exists($value)) {
                static::isInterfaceExists($parent, 'parent');
            } else {
                static::throwException($name, 'existing class or interface', $given);
            }
        } else {
            static::isObject($value, $name);
            $given = static::getType($value);
        }

        if (is_subclass_of($value, $parent) !== true) {
            static::throwException($name, $parent, $given);
        }
    }

    #endregion

    #region string operations

    /**
     * @param string $value
     * @param bool $accept_blanks
     * @param string $name
     */
    public static final function isNotEmptyString($value, $accept_blanks = false, $name = null)
    {
        static::isString($value, $name);

        if (!$accept_blanks) {
            $value = trim($value);
        }

        if (strlen($value) === 0) {
            static::throwException($name, 'non empty', $value);
        }
    }

    /**
     * @param string $value
     * @param string $starts_with
     * @param string $name
     */
    public static final function startsWith($value, $starts_with, $name = null)
    {
        static::isString($starts_with, 'starts with');

        $escaped_starts_with = preg_quote($starts_with, '/');
        $regex_pattern = "/^{$escaped_starts_with}/";
        static::isRegexMatches($value, $regex_pattern, $name);
    }

    /**
     * @param string $value
     * @param string $regex_pattern
     * @param string $name
     */
    public static final function isRegexMatches($value, $regex_pattern, $name = null)
    {
        static::isString($value, $name);
        static::isRegexPattern($regex_pattern, 'regex pattern');

        if (preg_match($regex_pattern, $value) !== 1) {
            static::throwException($name, $regex_pattern, $value);
        }
    }

    /**
     * @param string $value
     * @param string $name
     */
    public static final function isRegexPattern($value, $name = null)
    {
        if (static::isRegex($value) !== true) {
            static::throwException($name, 'regex', $value);
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
        static::isNotEmptyString($value, false, $name);
    }

    /**
     * @param string $value
     * @param string[] $allowed_string_list
     * @param string $name
     */
    public static final function isInStringArray($value, $allowed_string_list, $name = null)
    {
        static::isString($value);
        static::isArrayOfString($allowed_string_list);

        if (in_array($value, $allowed_string_list, true) !== true) {
            $excepted = implode(', or ', $allowed_string_list);
            static::throwException($name, $excepted, $value);
        }
    }

    #endregion

    #region array operations

    /**
     * @param array $value
     * @param string $name
     */
    public static final function isNotEmptyArray($value, $name = null)
    {
        static::isArray($value, $name);

        if (count($value) === 0) {
            static::throwException($name, 'non empty', static::getArrayAsString($value));
        }
    }

    /**
     * @param array $value
     * @param string $type
     * @param string $name
     */
    public static final function isArrayOfType($value, $type, $name = null)
    {
        static::isArray($value, $name);
        static::isTypeExists($type, 'type');

        foreach ($value as $element) {
            static::isType($element, $type, $name); // todo assertion message is misleading
        }
    }

    /**
     * @param string[] $value
     * @param string $name
     */
    public static final function isArrayOfString($value, $name = null)
    {
        static::isArray($value, $name);

        foreach ($value as $element) {
            static::isString($element, $name); // todo assertion message is misleading
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
            static::isNotEmptyArray($value, $name);
        } else {
            static::isArray($value, $name);
        }

        if (array_keys($value) !== range(0, count($value) - 1)) {
            static::throwException($name, 'sequential array', static::getArrayAsString($value));
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

    #region int operations

    /**
     * @param int $value
     * @param string $name
     *
     * @deprecated Use isPositiveInt instead
     * @see Assert::isPositiveInt()
     */
    public static final function isPositive($value, $name = null)
    {
        static::isPositiveInt($value, $name);
    }

    /**
     * @param int $value
     * @param string $name
     */
    public static final function isPositiveInt($value, $name = null)
    {
        static::isInt($value, $name);

        if ($value <= 0) {
            static::throwException($name, 'positive int', strval($value));
        }
    }

    /**
     * @param int $value
     * @param string $name
     *
     * @deprecated Use isNotNegativeInt() instead
     * @see Assert::isNotNegativeInt()
     */
    public static final function isNotNegative($value, $name = null)
    {
        static::isNotNegativeInt($value, $name);
    }

    /**
     * @param int $value
     * @param string $name
     */
    public static final function isNotNegativeInt($value, $name = null)
    {
        static::isInt($value, $name);

        if ($value < 0) {
            static::throwException($name, 'not negative int', strval($value));
        }
    }

    #endregion

    #region number operations

    /**
     * @param int|float|string $value
     * @param bool $allow_string
     * @param string $name
     */
    public static final function isPositiveNumber($value, $allow_string = false, $name = null)
    {
        static::isBoolean($allow_string, 'allow_string');
        if ($allow_string) {
            static::isNumeric($value, $name);
        } else {
            static::isIntOrFloat($value, $name);
        }

        if ($value <= 0) {
            $given_type = static::getType($value);
            static::throwException($name, 'positive number', $given_type);
        }
    }

    /**
     * @param int|float|string $value
     * @param bool $allow_string
     * @param string $name
     */
    public static final function isNotNegativeNumber($value, $allow_string = false, $name = null)
    {
        static::isBoolean($allow_string, 'allow_string');
        if ($allow_string) {
            static::isNumeric($value, $name);
        } else {
            static::isIntOrFloat($value, $name);
        }

        if ($value < 0) {
            $given_type = static::getType($value);
            static::throwException($name, 'not negative number', $given_type);
        }
    }

    #endregion

    #region internal

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
     * @param string $given
     * @param bool $use_child_class
     */
    protected static final function throwException($name, $expected, $given, $use_child_class = true)
    {
        if ($use_child_class === true) {
            $exception = static::generateException($name, $expected, $given);
            static::isTypePrivate($exception, AssertionExceptionInterface::class, 'exception');
        } else {
            $exception = self::generateException($name, $expected, $given);
        }

        throw $exception;
    }

    #endregion
}