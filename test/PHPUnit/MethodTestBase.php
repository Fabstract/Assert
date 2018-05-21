<?php

/** @noinspection PhpDocMissingThrowsInspection */

/** @noinspection PhpUnhandledExceptionInspection */

namespace Fabstract\Component\Assert\Test\PHPUnit;

abstract class MethodTestBase extends TestBase
{

    /**
     * @param object $object
     * @param array $parameters
     * @return mixed
     */
    protected function call($object, $parameters = [])
    {
        return $this->callObjectMethod($object, $this->getMethodValidated(), $parameters);
    }

    /**
     * @param string $class
     * @param array $parameters
     * @return mixed
     */
    protected function callStatic($class, $parameters = [])
    {
        return $this->callStaticMethod($class, $this->getMethodValidated(), $parameters);
    }

    /**
     * @return string
     */
    private function getMethodValidated()
    {
        $method = $this->getMethod();
        if (is_string($method) !== true) {
            $given = $method === null ? 'null' : get_class($method);
            throw new \Exception("getMethod should return string, given ${given}");
        }

        return $method;
    }

    /**
     * @return string
     */
    protected function getMethod()
    {
        $class_name_with_namespace = static::class;
        $exploded = explode('\\', $class_name_with_namespace);
        $class_name = $exploded[count($exploded) - 1];

        if (preg_match('/^(?<method_name>\w+)MethodTest$/', $class_name, $matches) !== 1) {
            throw new \Exception("Method test class name should end with 'MethodTest', given ${class_name}");
        }

        return lcfirst($matches['method_name']);
    }
}
