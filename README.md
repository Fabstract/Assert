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
more assertions fail. 

Imagine you write a function that adds two numbers and returns the result, like this:

    function add($x, $y){
        Assert::isNumeric($x); // throws exception if $x is not a number
        Assert::isNumeric($y); // throws exception if $y is not a number
        
        return $x + $y;
    }

Here you can just write some assertions to make sure your function gets valid parameters, or do not run at all otherwise.

The main benefit of using this library is to get meaningful exception messages. Consider below:

    function addToArray($key, $value){
        Assert::isValidArrayIndex($key, 'key');
        
        $this->array[$key] = $value;
    }
    
Imagine `addToArray` function gets passed `new stdClass()` as its first parameter. Without assertion, PHP will generate
following message:

     PHP Fatal error:  Illegal offset type

but with assertion, you will get this message:

    Variable with name "key" is expected to be valid array index, given stdClass.

which is way more meaningful.

By using assertion methods, you can prevent getting `Trying to get property of non object` messages almost %100 of the
time, thus debug a lot easier.

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
    - [isCallable($value, [$name])](#iscallablevalue-name--null)
    - [isString($value, [$name])](#isstringvalue-name--null)
    - [isBoolean($value, [$name])](#isbooleanvalue-name--null)
    - [isInt($value, [$name])](#isintvalue-name--null)
    - [isStringOrInt($value, [$name])](#isstringorintvalue-name--null)
    - [isIntOrFloat($value, [$name])](#isintorfloatvalue-name--null)
    - [isFloat($value, [$name])](#isfloatvalue-name--null)
    - [isValidArrayIndex($value, [$name])](#isvalidarrayindexvalue-name--null)
    - [isArray($value, [$name])](#isarrayvalue-name--null)
    - [isNumeric($value, [$name])](#isnumericvalue-name--null)
    - [isType($value, $type, [$name])](#istypevalue-type-name--null)
    - [isInstanceOf($value, $type, [$name])](#isinstanceofvalue-type-name--null)
    - [isOneOfTypes($value, $type_list, [$name])](#isoneoftypesvalue-type_list-name--null)
    - [isImplements($value, $interface, [$name])](#isimplementsvalue-interface-name--null)
    - [isChildOf($value, $parent, [$name])](#ischildofvalue-parent-name--null)
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
    Assert::isEqualTo(null, null, 'variable name'); // no exception
    
    Assert::isEqualTo(1, 1.0, 'variable name'); // exception!
    Assert::isEqualTo(1, '1', 'variable name'); // exception!

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

## Type Checkers

### isCallable($value, $name = null)

Checks if given `$value` is callable. Throws exception if fails.

This does not throw for closures, built-in php functions, public instance methods and public static methods. It **will throw** 
exception for protected and private instance and static methods. 

Optional parameter `$name` is used for exceptions. See [exceptions](#exceptions) for more info.

    Assert::isCallable(function(){}, 'variable name'); // no exception
    Assert::isCallable('str_replace', 'variable_name'); // no exception
    
    class SomeClass {
        public function somePublicMethod(){}
        public static function somePublicStaticMethod(){}
        protected function someProtectedMethod(){}
        public function somePrivateMethod(){}
    }
    
    Assert::isCallable(['someclass', 'somePublicMethod'], 'variable name'); // no exception
    Assert::isCallable(['someclass', 'somePublicStaticMethod'], 'variable name'); // no exception
    
    Assert::isCallable(['someclass', 'someProtectedMethod'], 'variable name'); // exception!
    Assert::isCallable(['someclass', 'somePrivateMethod'], 'variable name'); // exception!
    
Works with instances as well:
    
    $instance = new SomeClass();
    
    Assert::isCallable([$instance, 'somePublicMethod'], 'variable name'); // no exception
    Assert::isCallable([$instance, 'somePublicStaticMethod'], 'variable name'); // no exception
    
    Assert::isCallable([$instance, 'someProtectedMethod'], 'variable name'); // exception!
    Assert::isCallable([$instance, 'somePrivateMethod'], 'variable name'); // exception!

### isString($value, $name = null)

Checks if given `$value` is string. Throws exception if fails.

Optional parameter `$name` is used for exceptions. See [exceptions](#exceptions) for more info.

    Assert::isString('some string', 'variable name'); // no exception
    Assert::isString('', 'variable name'); // no exception
    
    Assert::isString(new stdClass(), 'variable name'); // exception!
    Assert::isString(null, 'variable name'); // exception!

### isBoolean($value, $name = null)

Checks if given `$value` is boolean, that is `true` or `false`. Throws exception if fails.

Optional parameter `$name` is used for exceptions. See [exceptions](#exceptions) for more info.

    Assert::isBoolean(true, 'variable name'); // no exception
    Assert::isBoolean(false, 'variable name'); // no exception
    
    Assert::isBoolean('true', 'variable name'); // exception!
    Assert::isBoolean(1, 'variable name'); // exception!

### isInt($value, $name = null)

Checks if given `$value` is int. Throws exception if fails.

This method is type safe, meaning that it will fail when `$value` is string `'1'`.

Optional parameter `$name` is used for exceptions. See [exceptions](#exceptions) for more info.

    Assert::isInt(1, 'variable name'); // no exception
    Assert::isInt(0, 'variable name'); // no exception
    
    Assert::isInt('1', 'variable name'); // exception!

### isStringOrInt($value, $name = null)

Checks if given `$value` is string or int. Throws exception if fails.

Optional parameter `$name` is used for exceptions. See [exceptions](#exceptions) for more info.

    Assert::isStringOrInt(0, 'variable name'); // no exception
    Assert::isStringOrInt('0', 'variable name'); // no exception
    
    Assert::isStringOrInt(null, 'variable name'); // exception!
    Assert::isStringOrInt([], 'variable name'); // exception!

### isIntOrFloat($value, $name = null)

Checks if given `$value` is int or float. Throws exception if fails.

Optional parameter `$name` is used for exceptions. See [exceptions](#exceptions) for more info.

    Assert::isIntOrFloat(0, 'variable name'); // no exception
    Assert::isIntOrFloat(0.5, 'variable name'); // no exception
    
    Assert::isIntOrFloat('0.5', 'variable name'); // exception!
    Assert::isIntOrFloat('1', 'variable name'); // exception!
    
### isFloat($value, $name = null)

Checks if given `$value` is float. Throws exception if fails.

Optional parameter `$name` is used for exceptions. See [exceptions](#exceptions) for more info.

    Assert::isFloat(0.5, 'variable name'); // no exception
    
    Assert::isFloat('0.5', 'variable name'); // exception!
    
### isValidArrayIndex($value, $name = null)

Checks if given `$value` can be used as array index. Throws exception if fails.

**Note:** Remember that in PHP, only strings and integers can be index. Floats and `null` are also valid indexes but they get converted
to integer or string first.

Optional parameter `$name` is used for exceptions. See [exceptions](#exceptions) for more info.

    Assert::isValidArrayIndex(1, 'variable name'); // no exception
    Assert::isValidArrayIndex('some string', 'variable name'); // no exception
    Assert::isValidArrayIndex(null, 'variable name'); // no exception
    Assert::isValidArrayIndex(0.5, 'variable name'); // no exception
    Assert::isValidArrayIndex(-1, 'variable name'); // no exception
    Assert::isValidArrayIndex(true, 'variable name'); // no exception
    Assert::isValidArrayIndex(false, 'variable name'); // no exception
    
    Assert::isValidArrayIndex([], 'variable name'); // exception!
    Assert::isValidArrayIndex(new stdClass(), 'variable name'); // exception!

### isArray($value, $name = null)

Checks if given `$value` is array. Throws exception if fails.

Optional parameter `$name` is used for exceptions. See [exceptions](#exceptions) for more info

    Assert::isArray([], 'variable name'); // no exception
    
    Assert::isArray(1, 'variable name'); // exception!
    
### isNumeric($value, $name = null)

Checks if given `$value` is numeric value. Throws exception if fails.

Valid values are integers, floats and numeric strings.

Optional parameter `$name` is used for exceptions. See [exceptions](#exceptions) for more info.

    Assert::isNumeric(1, 'variable name'); // no exception
    Assert::isNumeric(1.5, 'variable name'); // no exception
    Assert::isNumeric('1.5', 'variable name'); // no exception
    Assert::isNumeric(INF, 'variable name'); // no exception
    
    Assert::isNumeric([], 'variable name'); // exception!
    Assert::isNumeric(true, 'variable name'); // exception!

### isType($value, $type, $name = null)

Checks if given `$value` is instance of `$type`. Throws exception if fails.

This method works for classes and interfaces, and their children.

Note that `null` values always throw.Traits also fails since traits are not types.

Optional parameter `$name` is used for exceptions. See [exceptions](#exceptions) for more info.

    class SomeClass {}
    
    Assert::isType(new SomeClass(), SomeClass::class, 'variable name'); // no exception
    
    Assert::isType(null, SomeClass::class, 'variable name'); // exception!
    
### isInstanceOf($value, $type, $name = null)

See [isType($value, $type, [$name])](#istypevalue-type-name--null).

### isOneOfTypes($value, $type_list, $name = null)

Checks if given `$value` is instance of one of types from `$type_list`. Throws exception if fails.

Optional parameter `$name` is used for exceptions. See [exceptions](#exceptions) for more info.

    class SomeClass {}
    
    Assert::isOneOfTypes(new SomeClass(), [SomeClass:class]); // no exception
    
    Assert::isOneOfTypes(new stdClass(), [SomeClass:class]); // exception!

### isImplements($value, $interface, $name = null)

Checks if given `$value` implements given `$interface`. Throws exception if fails.

Optional parameter `$name` is used for exceptions. See [exceptions](#exceptions) for more info.

    interface SomeInterface {}
    
    class SomeClass implements SomeInterface {}
    
    Assert::isImplements(new SomeClass(), 'someinterface'); // no exception
    Assert::isImplements('someclass', 'someinterface'); // no exception
    
    Assert::isImplements(new stdClass(), 'someinterface'); // exception!
    Assert::isImplements(new stdClass(), 'someclass'); // exception!

### isChildOf($value, $parent, $name = null)

Checks if given `$value` is child of `$parent`. Throws exception if fails.

Note that `$value` and `$parent` are the same, this method still throws.

Optional parameter `$name` is used for exceptions. See [exceptions](#exceptions) for more info.

    class SomeClass {}
    class ChildClass extends SomeClass {}
    
    Assert::isChildOf('childclass', 'someclass', 'variable name'); // no exception
    Assert::isChildOf(new ChildClass(), 'someclass', 'variable name'); // no exception
    Assert::isChildOf(new ChildClass(), SomeClass::class, 'variable name'); // no exception
    
    Assert::isChildOf(new SomeClass(), SomeClass::class, 'variable name'); // exception!

Works with interfaces and child interfaces too.
    
    interface SomeInterface {}
    interface ChildInterface {}
    
    class SomeClass implements SomeInterface {}
    
    Assert::isChildOf('someclass', 'someinterface', 'variable name'); // no exception
    Assert::isChildOf('childinterface', 'someinterface', 'variable name'); // no exception
    
    Assert::isChildOf('someinterface', 'someinterface', 'variable name'); // exception!
    

## Exceptions

[todo2](#TODO2)