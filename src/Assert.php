<?php


namespace Fabs\Component\Assert;


class Assert
{
    public static final function assertArray($value, $name)
    {
        if (!is_array($value)) {
            $given_type = static::getType($value);
            $exception = static::generateException($name, 'array', $given_type);
            if ($exception instanceof AssertExceptionInterface) {
                throw new AssertException('Exception must implement ' . AssertExceptionInterface::class);
            }
        }
    }

    public static final function assertString($value, $name)
    {
        if (!is_string($value)) {
            $given_type = static::getType($value);
            $exception = static::generateException($name, 'string', $given_type);
            if ($exception instanceof AssertExceptionInterface) {
                throw new AssertException('Exception must implement ' . AssertExceptionInterface::class);
            }
        }
    }

    protected static function generateException($name, $expected, $given)
    {
        $message = sprintf(
            '%s expected %s, given %s',
            $name,
            $expected,
            $given
        );
        return new AssertException($message);
    }

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
}