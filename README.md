# PHPClassMapper
A simple package that provides you with a simple class mapping system.

## Table of Contents

<!-- TOC -->

- [PHPClassMapper](#phpclassmapper)
    - [Table of Contents](#table-of-contents)
    - [Features](#features)
    - [Installation](#installation)
    - [usage](#usage)
        - [Class to class mapping](#class-to-class-mapping)
            - [Configuring the mapper](#configuring-the-mapper)
            - [Creating a mapping](#creating-a-mapping)
            - [Creating the mapper](#creating-the-mapper)
            - [Using the mapper](#using-the-mapper)
        - [Array mapping](#array-mapping)
            - [Configuring the mapper](#configuring-the-mapper-1)
            - [Creating a mapping](#creating-a-mapping-1)
            - [Creating the mapper](#creating-the-mapper-1)
            - [Using the mapper](#using-the-mapper-1)
    - [Dependency injection containers](#dependency-injection-containers)

<!-- /TOC -->

## Features
PHPClassMapper comes with the following features:

- Class to class mapping
- Array to class mapping
- Class to array mapping

## Installation
```bash
$ composer require guyliangilsing/php-class-mapper
```

## usage
### Class to class mapping
#### Configuring the mapper
You need to supply a configuration class before you can create the mapper class. You can create a configuration as follows:

```php
use PHPClassMapper\Configuration\MapperConfiguration;

$configuration = new MapperConfiguration();
```

In this configuration you can add a mapping with the following code:

```php
use PHPClassMapper\Configuration\MapperConfiguration;

$configuration = new MapperConfiguration();
$configuration->addMapping(Source::class, Destination::class, new MyMapping());
```

#### Creating a mapping
To let the mapper know how to map your classes, you need to provide it with a mapping. A mapping can be created as follows:

```php
class MyMapping implements MappingInterface
{
    /**
     * Maps one class into another class.
     *
     * @param object $source The class that needs to be mapped to a different class.
     * @param array<string, mixed> $contextData An associative array (key => value) that gives the mapper additional
     * data to work with.
     *
     * @throws InvalidArgumentException when a `MyClass::name` string refers to a class that does not exist.
     * @throws MissingMappingException when a mapping between two class types can't be found.
     * @throws MissingContextDataFieldException when a specific context data field can't be found.
     */
    public function mapObject(object $source, array $contextData): object
    {
        if (!($source instanceof Source))
        {
            throw new MissingMappingException($source::class, Destination::class);
        }

        return new Destination();
    }
}
```

#### Creating the mapper
Once you have your configuration, you can instantiate a mapper:

```php
use PHPClassMapper\Configuration\MapperConfiguration;
use PHPClassMapper\Mapper;

$configuration = new MapperConfiguration();

// Do your configuration logic here...

$mapper = new Mapper($configuration);
```

#### Using the mapper
Once you have the mapper instantiated, you can use it in the following way:

```php
use PHPClassMapper\Configuration\MapperConfiguration;
use PHPClassMapper\Mapper;

$configuration = new MapperConfiguration();

// Do your configuration logic here...

$mapper = new Mapper($configuration);

// Without contextvariables
$mapper->map($source, Destination::class);

// With context variables
$mappedClass = $mapper->map($source, Destination::class, [
    'contextFieldOne' => 'Hello',
    'contextFieldTwo' => 'World'
]);
```

### Array mapping
#### Configuring the mapper
You need to supply a configuration class before you can create the mapper class. You can create a configuration as follows:

```php
use PHPClassMapper\Configuration\ArrayMapperConfiguration;

$configuration = new ArrayMapperConfiguration();
```

In this configuration you can add two different mapping types:

- To array mapping (class -> array)
- From array mapping (array -> class)

**To array mapping**<br/>
```php
use PHPClassMapper\Configuration\ArrayMapperConfiguration;

$configuration = new ArrayMapperConfiguration();
$configuration->addToArrayMapping(Source::class, new ToArrayMapping());
```

**From array mapping**<br/>
```php
use PHPClassMapper\Configuration\ArrayMapperConfiguration;

$configuration = new ArrayMapperConfiguration();
$configuration->addFromArrayMapping(Destination::class, new FromArrayMapping());
```

#### Creating a mapping
Since you can map arrays in two different ways, two different interfaces are being used:

- ToArrayMappingInterface
- FromArrayMappingInterface

**To array mapping**<br/>
```php
use PHPClassMapper\Configuration\ToArrayMappingInterface;

final class ToArrayMapping implements ToArrayMappingInterface
{
    /**
     * @param object $source The class that needs to be mapped to an array.
     * @param array<string, mixed> $contextData An associative array (key => value) that gives the mapper additional
     * data to work with.
     *
     * @throws InvalidArgumentException when a `MyClass::name` string refers to a class that does not exist.
     * @throws MissingMappingException when a mapping between two class types can't be found.
     * @throws MissingContextDataFieldException when a specific context data field can't be found.
     */
    public function mapObject(object $source, array $contextData = []): array
    {
        return [];
    }
}
```

**From array mapping**<br/>
```php
use PHPClassMapper\Configuration\FromArrayMappingInterface;

final class FromArrayMapping implements FromArrayMappingInterface
{
    /**
     * @param array<string, mixed> $source The class that needs to be mapped to a different class.
     * @param array<string, mixed> $contextData An associative array (key => value) that gives the mapper additional
     * data to work with.
     *
     * @throws MissingMappingException when a mapping between two class types can't be found.
     * @throws MissingContextDataFieldException when a specific context data field can't be found.
     */
    public function mapObject(array $source, array $contextData = []): object
    {
        return new Destination();
    }
}
```

#### Creating the mapper
Once you have your configuration, you can instantiate a mapper:

```php
use PHPClassMapper\Configuration\ArrayMapperConfiguration;
use PHPClassMapper\ArrayMapper;

$configuration = new ArrayMapperConfiguration();

// Do your configuration logic here...

$mapper = new ArrayMapper($configuration);
```

#### Using the mapper
Once you have the mapper instantiated, you can use it in the following way:

```php
use PHPClassMapper\Configuration\ArrayMapperConfiguration;
use PHPClassMapper\ArrayMapper;

$configuration = new ArrayMapperConfiguration();

// Do your configuration logic here...

$mapper = new ArrayMapper($configuration);

// To array mapping
$objToMap = // Your object here...
$mappedArray = $mapper->toArray($objToMap);

// From array mapping
$mappedObject = $mapper->fromArray([], Destination::class);

```

## Dependency injection containers
You can register the mapper with your favorite dependency injection container by using the `MapperInterface` and `MapperConfigurationInterface` interfaces.
