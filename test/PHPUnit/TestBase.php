<?php

/** @noinspection PhpDocMissingThrowsInspection */

/** @noinspection PhpUnhandledExceptionInspection */

namespace Fabstract\Component\Assert\Test\PHPUnit;

use PHPUnit\Framework\TestCase;

abstract class TestBase extends TestCase
{

    /**
     * @param object $object
     * @param string $method_name
     * @param array $parameters
     * @return mixed
     */
    protected function callObjectMethod($object, $method_name, $parameters = [])
    {
        if ($object === null) {
            throw new \Exception('object cannot be null');
        }

        if (is_object($object) !== true) {
            throw new \Exception('object parameter is expected to be valid object, ' . get_class($object) . ' given');
        }

        $class = get_class($object);

        if (is_string($method_name) !== true) {
            throw new \Exception('method_name is expected to be string, ' . get_class($object) . ' given');
        }

        if (method_exists($object, $method_name) !== true) {
            throw new \Exception("Method ${method_name} does not exists in class ${class}");
        }

        if (is_array($parameters) !== true) {
            $given = get_class($parameters);
            throw new \Exception("Parameters should be array, given ${given}");
        }

        /** @noinspection PhpUnhandledExceptionInspection */
        $reflection = new \ReflectionClass(get_class($object));
        $method = $reflection->getMethod($method_name);
        $method->setAccessible(true);

        return $method->invokeArgs($object, $parameters);
    }

    /**
     * @param string $class
     * @param string $method_name
     * @param array $parameters
     * @return mixed
     */
    protected function callStaticMethod($class, $method_name, $parameters = [])
    {
        if (is_string($class) !== true) {
            $given = get_class($class);
            throw new \Exception("Parameter class is expected to be valid class name, given ${given}");
        }

        if (class_exists($class) !== true) {
            throw new \Exception("Parameter class is expected to be valid class name, given ${class}");
        }

        if (is_string($method_name) !== true) {
            throw new \Exception('method_name is expected to be string, ' . $class . ' given');
        }

        if (method_exists($class, $method_name) !== true) {
            throw new \Exception("Method ${method_name} does not exists in class ${class}");
        }

        if (is_array($parameters) !== true) {
            $given = get_class($parameters);
            throw new \Exception("Parameters should be array, given ${given}");
        }

        $reflection = new \ReflectionClass($class);
        $method = $reflection->getMethod($method_name);
        $method->setAccessible(true);

        return $method->invokeArgs(null, $parameters);
    }
}
