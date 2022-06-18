# PHPClassMapper
A simple package that provides you with a simple class mapping system.

## Table of Contents

<!-- TOC -->

- [PHPClassMapper](#phpclassmapper)
    - [Table of Contents](#table-of-contents)
    - [Installation](#installation)
    - [Usage](#usage)
        - [Configuring the mapper](#configuring-the-mapper)
        - [Creating a mapping](#creating-a-mapping)
        - [Creating the mapper](#creating-the-mapper)
        - [Using the mapper](#using-the-mapper)
    - [Dependency injection containers](#dependency-injection-containers)

<!-- /TOC -->

## Installation
```bash
$ composer require guyliangilsing/php-class-mapper
```

## Usage
### Configuring the mapper
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

### Creating a mapping
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

### Creating the mapper
Once you have your configuration, you can instantiate a mapper:

```php
use PHPClassMapper\Configuration\MapperConfiguration;
use PHPClassMapper\Mapper;

$configuration = new MapperConfiguration();

// Do your configuration logic here...

$mapper = new Mapper($configuration);
```

### Using the mapper
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

## Dependency injection containers
You can register the mapper with your favorite dependency injection container by using the `MapperInterface` and `MapperConfigurationInterface` interfaces.
