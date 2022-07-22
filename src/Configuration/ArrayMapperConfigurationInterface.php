<?php

declare(strict_types=1);

namespace PHPClassMapper\Configuration;

use PHPClassMapper\Exceptions\MissingArrayMappingException;

interface ArrayMapperConfigurationInterface
{
    /**
     * Adds an array mapping that converts an object to an array.
     *
     * @param string $sourceClassName The `MyClass::name` string of the class that needs to be mapped to an array.
     *
     * @throws InvalidArgumentException when a mapping already exists.
     */
    public function addToArrayMapping(string $sourceClassName, ToArrayMappingInterface $mapping): void;

    /**
     * Retrieves a `ToArrayMappingInterface` class.
     *
     * @param string $sourceClassName The `MyClass::name` string of the class that needs to be mapped to an array.
     *
     * @throws MissingArrayMappingException when a mapping does not exists.
     */
    public function getToArrayMapping(string $sourceClassName): ToArrayMappingInterface;

    /**
     * Adds an array mapping that converts an array to an object.
     *
     * @param string $destinationClassName The `MyClass::name` string of the class that the mapper needs to return.
     *
     * @throws InvalidArgumentException when a mapping already exists.
     */
    public function addFromArrayMapping(string $destinationClassName, FromArrayMappingInterface $mapping): void;

    /**
     * Retrieves a `FromArrayMappingInterface` class.
     *
     * @param string $destinationClassName The `MyClass::name` string of the class that the mapper needs to return.
     *
     * @throws MissingArrayMappingException when a mapping does not exists.
     */
    public function getFromArrayMapping(string $destinationClassName): FromArrayMappingInterface;
}
