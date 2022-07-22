<?php

declare(strict_types=1);

namespace PHPClassMapper\Tests\Mocks\MappingConfigurations;

use PHPClassMapper\ArrayMapperInterface;
use PHPClassMapper\Configuration\ArrayMapperConfigurationInterface;
use PHPClassMapper\Configuration\FromArrayMappingInterface;
use PHPClassMapper\Configuration\ToArrayMappingInterface;
use PHPClassMapper\Tests\Fixtures\Mapping\FromArrayMapping;
use PHPClassMapper\Tests\Fixtures\Mapping\ToArrayMapping;

final class SimpleArrayMappingConfigurationMock implements ArrayMapperConfigurationInterface
{
    private object $objectToReturn;
    private array $arrayToReturn = [];

    public function __construct(object $objectToReturn, array $arrayToReturn = [])
    {
        $this->objectToReturn = $objectToReturn;
        $this->arrayToReturn = $arrayToReturn;
    }

    /**
     * Adds an array mapping that converts an object to an array.
     *
     * @param string $sourceClassName The `MyClass::name` string of the class that needs to be mapped to an array.
     *
     * @throws InvalidArgumentException when a mapping already exists.
     */
    public function addToArrayMapping(string $sourceClassName, ToArrayMappingInterface $mapping): void
    {
        // Do nothing...
    }

    /**
     * Retrieves a `ToArrayMappingInterface` class.
     *
     * @param string $sourceClassName The `MyClass::name` string of the class that needs to be mapped to an array.
     *
     * @throws MissingArrayMappingException when a mapping does not exists.
     */
    public function getToArrayMapping(string $sourceClassName): ToArrayMappingInterface
    {
        return new ToArrayMapping();
    }

    /**
     * Adds an array mapping that converts an array to an object.
     *
     * @param string $destinationClassName The `MyClass::name` string of the class that the mapper needs to return.
     *
     * @throws InvalidArgumentException when a mapping already exists.
     */
    public function addFromArrayMapping(string $destinationClassName, FromArrayMappingInterface $mapping): void
    {
        // Do nothing...
    }

    /**
     * Retrieves a `FromArrayMappingInterface` class.
     *
     * @param string $destinationClassName The `MyClass::name` string of the class that the mapper needs to return.
     *
     * @throws MissingArrayMappingException when a mapping does not exists.
     */
    public function getFromArrayMapping(string $destinationClassName): FromArrayMappingInterface
    {
        return new FromArrayMapping();
    }
}

