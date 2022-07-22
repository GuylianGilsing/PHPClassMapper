<?php

declare(strict_types=1);

namespace PHPClassMapper\Configuration;

use InvalidArgumentException;
use PHPClassMapper\Exceptions\MissingArrayMappingException;
use PHPClassMapper\Exceptions\MissingMappingException;
use PHPClassMapper\Exceptions\Types\ArrayMappingExceptionTypes;

final class ArrayMapperConfiguration implements ArrayMapperConfigurationInterface
{
    /**
     * @var array<string, ToArrayMappingInterface > $toArrayMappings
     */
    private array $toArrayMappings = [];

    /**
     * @var array<string, FromArrayMappingInterface > $fromArrayMappings
     */
    private array $fromArrayMappings = [];

    /**
     * Adds an array mapping that converts an object to an array.
     *
     * @param string $sourceClassName The `MyClass::name` string of the class that needs to be mapped to an array.
     *
     * @throws InvalidArgumentException when a mapping already exists.
     */
    public function addToArrayMapping(string $sourceClassName, ToArrayMappingInterface $mapping): void
    {
        if ($this->toMappingExists($sourceClassName))
        {
            throw new InvalidArgumentException("To array mapping for '".$sourceClassName."' already exists.");
        }

        $this->toArrayMappings[$sourceClassName] = $mapping;
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
        if (!$this->toMappingExists($sourceClassName))
        {
            throw new MissingArrayMappingException($sourceClassName, ArrayMappingExceptionTypes::TO);
        }

        return $this->toArrayMappings[$sourceClassName];
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
        if ($this->fromMappingExists($destinationClassName))
        {
            throw new InvalidArgumentException("From array mapping for '".$destinationClassName."' already exists.");
        }

        $this->fromArrayMappings[$destinationClassName] = $mapping;
    }

    /**
     * Retrieves a `FromArrayMappingInterface` class.
     *
     * @param string $destinationClassName The `MyClass::name` string of the class that the mapper needs to return.
     *
     * @throws MissingMappingException when a mapping does not exists.
     */
    public function getFromArrayMapping(string $destinationClassName): FromArrayMappingInterface
    {
        if (!$this->fromMappingExists($destinationClassName))
        {
            throw new MissingArrayMappingException($destinationClassName, ArrayMappingExceptionTypes::FROM);
        }

        return $this->fromArrayMappings[$destinationClassName];
    }

    private function toMappingExists(string $sourceClassName): bool
    {
        return array_key_exists($sourceClassName, $this->toArrayMappings);
    }

    private function fromMappingExists(string $destinationClassName): bool
    {
        return array_key_exists($destinationClassName, $this->fromArrayMappings);
    }
}
