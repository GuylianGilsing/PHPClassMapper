<?php

declare(strict_types=1);

namespace PHPClassMapper\Configuration;

use InvalidArgumentException;
use PHPClassMapper\Exceptions\MissingMappingException;

final class MapperConfiguration implements MapperConfigurationInterface
{
    /**
     * @var array<key, array<key, MappingInterface>> $mappings An associative (key => value) array that holds
     * all the added mappings.
     */
    private array $mappings = [];

    /**
     * Adds a new `MappingInterface` class.
     *
     * @param string $sourceClassName The `MyClass::name` string of the class that needs to be mapped to a
     * different class.
     * @param string $destinationClassName The `MyClass::name` string of the class that the mapper needs to return.
     *
     * @throws InvalidArgumentException when a mapping already exists.
     */
    public function addMapping(string $sourceClassName, string $destinationClassName, MappingInterface $mapping): void
    {
        if ($this->mappingExists($sourceClassName, $destinationClassName))
        {
            throw new InvalidArgumentException(
                "Mapping for '".$sourceClassName."' already exists within mapping group: '".$destinationClassName."'"
            );
        }

        $this->mappings[$destinationClassName][$sourceClassName] = $mapping;
    }

    /**
     * Retrieves a `MappingInterface` class.
     *
     * @param string $sourceClassName The `MyClass::name` string of the class that needs to be mapped to a
     * different class.
     * @param string $destinationClassName The `MyClass::name` string of the class that the mapper needs to return.
     *
     * @throws MissingMappingException when a mapping does not exists.
     */
    public function getMapping(string $sourceClassName, string $destinationClassName): MappingInterface
    {
        if (!$this->mappingExists($sourceClassName, $destinationClassName))
        {
            throw new MissingMappingException($sourceClassName, $destinationClassName);
        }

        return $this->mappings[$destinationClassName][$sourceClassName];
    }

    /**
     * @param string $sourceClassName The `MyClass::name` string of the class that needs to be mapped to a
     * different class.
     * @param string $destinationClassName The `MyClass::name` string of the class that the mapper needs to return.
     */
    private function mappingExists(string $sourceClassName, string $destinationClassName): bool
    {
        if (!array_key_exists($destinationClassName, $this->mappings))
        {
            return false;
        }

        if (!array_key_exists($sourceClassName, $this->mappings[$destinationClassName]))
        {
            return false;
        }

        return true;
    }
}
