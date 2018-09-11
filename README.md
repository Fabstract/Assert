<p align="center"><img src="https://avatars3.githubusercontent.com/u/36798053?s=200&v=4"></p>

<p align="center">
    <a href="https://travis-ci.org/Fabstract/Assert"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
    <a href="https://packagist.org/packages/fabstract/assert"><img src="https://poser.pugx.org/fabstract/assert/d/total.svg" alt="Total Downloads"></a>
    <a href="https://packagist.org/packages/fabstract/assert"><img src="https://poser.pugx.org/fabstract/assert/v/stable.svg" alt="Latest Stable Version"></a>
    <a href="https://packagist.org/packages/fabstract/assert"><img src="https://poser.pugx.org/fabstract/assert/license.svg" alt="License"></a>
</p>

## Assert

This library introduces a set of methods to check if a variable or variables obey some restrictions. These methods are
especially useful for checking method parameters. All methods throw [AssertionExceptionInterface](https://github.com/Fabstract/Assert/blob/master/src/AssertionExceptionInterface.php) should one or 
more requirements fail. 

Imagine you write a function that adds two numbers and returns the result, like this:

    function add($x, $y){
        Assert::isNumeric($x); // throws exception if $x is not a number
        Assert::isNumeric($y); // throws exception if $y is not a number
        
        return $x + $y;
    }

Here you can just write some assertions to make sure your function gets valid parameters, or do not run at all 
otherwise.

## Installation

1. Install [composer](https://getcomposer.org/download/).
2. Run `composer require fabstract/assert`.


## Functions

- [General operations](#general-operations)
    - [isObject($value, [$name])](#isobjectvalue-name--null)
    - [isNotNull($value, [$name])](#isnotnullvalue-name--null)
    - [isEqualTo($value, $expected, [$name])](#isequaltovalue-excepted-name--null)
    - [isNotEqualTo($value, $expected, [$name])](#isnotequaltovalue-expected-name--null)
    - [isTypeExists($value, [$name])](#istypeexistsvalue-name--null)
    - [isClassExists($value, [$name])](#isclassexistsvalue-name--null)
    - [isInterfaceExists($value, [$name])](#isinterfaceexistsvalue-name--null)
    - [isMethodExists($object_or_class_name, $method, [$name])](#ismethodexistsobject_or_class_name-method-name--null)
    - [isInArray($value, $allowed_value_list, [$type_strict], [$name])](#isinarrayvalue-allowed_value_list-type_strict--false-name--null)
- [Type checkers](#type-checkers)
    - [isCallable($value, $name)](#is-callable)
    - [isString($value, $name)](#is-string)
    - [isBoolean($value, $name)](#is-boolean)
    - [isInt($value, $name)](#is-int)
    - [isStringOrInt($value, $name)](#is-string-or-int)
    - [isIntOrFloat($value, $name)](#is-int-or-float)
    - [isFloat($value, $name)](#is-float)
    - [isArray($value, $name)](#is-array)
    - [isNumeric($value, $name)](#is-numeric)
    - [isType($value, $type, $name)](#is-type)
    - [isInstanceOf($value, $type, $name)](#is-instance-of)
    - [isOneOfTypes($value, $type_list, $name)](#is-one-of-types)
    - [isImplements($value, $interface, $name)](#is-implements)
    - [isChildOf($value, $parent, $name)](#is-child-of)
- [String operations](#string-operations)
    - [isNotEmptyString($value, $accept_blanks, $name)](#is-not-empty-string)
    - [startsWith($value, $starts_with, $name)](#starts-with)
    - [isRegexMatches($value, $regex_pattern, $name)](#is-regex-matches)
    - [isRegexPattern($value, $name)](#is-regex-pattern)
    - [isNotNullOrWhiteSpace($value, $name)](#is-not-null-or-white-space)
    - [isInStringArray($value, $allowed_string_list, $name)](#is-in-string-array)
- [Array operations](#array-operations)
    - [isNotEmptyArray($value, $name)](#is-not-empty-array)
    - [isArrayOfType($value, $type, $name)](#is-array-of-type)
    - [isArrayOfString($value, $name)](#is-array-of-string)
    - [isSequentialArray($value, $accept_empty, $name)](#is-sequential-array)
- [Int operations](#int-operations)
    - [isPositiveInt](#is-positive-int)
    - [isNotNegativeInt](#is-not-negative-int)
- [Number operations](#number-operations)
    - [isPositiveNumber($value, $allow_string, $name)](#is-positive-number)
    - [isNotNegativeNumber($value, $allow_string, $name)](#is-not-negative-number)
    
## General operations

### isObject($value, $name = null)

Checks if given `$value` is object. Throws exception if fails.
 
Optional parameter `$name` is used for exceptions. See [exceptions](#exceptions) for more info.

    Assert::isObject(new stdClass(), 'variable name'); // no exception
    Assert::isObject(1, 'variable name'); // exception!
    
### isNotNull($value, $name = null)

Checks if given `$value` is not null. Throws exception if fails.

Optional parameter `$name` is used for exceptions. See [exceptions](#exceptions) for more info.

    Assert::isNotNull(5, 'variable name'); // no exception
    Assert::isNotNull(null, 'variable name'); // exception!

### isEqualTo($value, $excepted, $name = null)

Checks if given `$value` is equal to `$expected`. Throws exception if fails. 

This method is type safe, meaning that it will fail when `$value` is integer `1` and `$expected` is string `'1'`.

Optional parameter `$name` is used for exceptions. See [exceptions](#exceptions) for more info.

    Assert::isEqualTo(1, 1, 'variable name'); // no exception
    Assert::isEqualTo(1, 1.0, 'variable name'); // exception!
    Assert::isEqualTo(1, '1', 'variable name'); // exception!
    Assert::isEqualTo(null, null, 'variable name'); // no exception

### isNotEqualTo($value, $expected, $name = null)

Checks if given `$value` is **NOT** equal to `$expected`. Throws exception if fails.

This method is type safe, meaning that it will **NOT** fail when `$value` is integer `1` and `$expected` is string `'1'`.

Optional parameter `$name` is used for exceptions. See [exceptions](#exceptions) for more info.

    Assert::isEqualTo(1, 1.0, 'variable name'); // no exception
    Assert::isEqualTo(1, '1', 'variable name'); // no exception
    Assert::isEqualTo(1, 1, 'variable name'); // exception!
    Assert::isEqualTo(null, null, 'variable name'); // exception!
    
### isTypeExists($value, $name = null)

Checks if there is a class or interface named `$value`. Throws exception if fails.

Optional parameter `$name` is used for exceptions. See [exceptions](#exceptions) for more info.

    class SomeClass {}
    interface SomeInterface {}
    Assert::isTypeExists('someclass', 'variable name'); // no exception
    Assert::isTypeExists('someinterface', 'variable name'); // no exception
    Assert::isTypeExists('someclass2', 'variable name'); // exception!
    
### isClassExists($value, $name = null)

Checks if there is a class named `$value`. Throws exception if fails.

Optional parameter `$name` is used for exceptions. See [exceptions](#exceptions) for more info.

    class SomeClass {}
    interface SomeInterface {}
    Assert::isClassExists('someclass', 'variable name'); // no exception
    Assert::isClassExists('someinterface', 'variable name'); // exception!
    Assert::isClassExists('someclass2', 'variable name'); // exception!    
    
### isInterfaceExists($value, $name = null)

Checks if there is an interface named `$value`. Throws exception if fails.

Optional parameter `$name` is used for exceptions. See [exceptions](#exceptions) for more info.

    class SomeClass {}
    interface SomeInterface {}
    Assert::isInterfaceExists('someinterface', 'variable name'); // no exception
    Assert::isInterfaceExists('someclass', 'variable name'); // exception!

### isMethodExists($object_or_class_name, $method, $name = null)

Checks if there is a method called `$method` inside `$object_or_class_name`. Throws exception if fails.

Optional parameter `$name` is used for exceptions. See [exceptions](#exceptions) for more info.

    trait SomeTrait {
        public function somePublicTraitMethod {}
        private function somePrivateTraitMethod {}
    }
    
    trait SomeOtherTrait {
        public function someOtherPublicTraitMethod {}
    }

    class SomeClass {
    
        use SomeTrait;
        
        public function somePublicMethod(){}
        private function somePrivateMethod(){}
    }
    
    Assert::isMethodExists('someclass', 'somePublicMethod', 'variable name'); // no exception
    Assert::isMethodExists('someclass', 'somePrivateMethod', 'variable name'); // no exception
    Assert::isMethodExists('someclass', 'somePublicTraitMethod', 'variable name'); // no exception
    Assert::isMethodExists('someclass', 'somePrivateTraitMethod', 'variable name'); // no exception
    Assert::isMethodExists('someclass', 'someOtherPublicTraitMethod', 'variable name'); // exception!
    Assert::isMethodExists('someclass', 'someMethodThatDoesNotExist', 'variable name'); // exception!
    
Works with instances as well:

    $instance = new SomeClass();

    Assert::isMethodExists($instance, 'somePublicMethod', 'variable name'); // no exception
    Assert::isMethodExists($instance, 'somePrivateMethod', 'variable name'); // no exception
    Assert::isMethodExists($instance, 'somePublicTraitMethod', 'variable name'); // no exception
    Assert::isMethodExists($instance, 'somePrivateTraitMethod', 'variable name'); // no exception
    Assert::isMethodExists($instance, 'someOtherPublicTraitMethod', 'variable name'); // exception!
    Assert::isMethodExists($instance, 'someMethodThatDoesNotExist', 'variable name'); // exception!

### isInArray($value, $allowed_value_list, $type_strict = false, $name = null)

Checks if given `$value` is in given array `$allowed_value_list`. Throws exception if fails.

Optional parameter `$name` is used for exceptions. See [exceptions](#exceptions) for more info.

    $allowed_value_list = ['1', '2', '3'];
    Assert::isInArray('1', $allowed_value_list, true, 'variable name'); // no exception
    Assert::isInArray('1', $allowed_value_list, false, 'variable name'); // no exception
    Assert::isInArray(1, $allowed_value_list, false, 'variable name'); // no exception
    Assert::isInArray(1, $allowed_value_list, true, 'variable name'); // exception!

## Exceptions

[todo2](#TODO2)