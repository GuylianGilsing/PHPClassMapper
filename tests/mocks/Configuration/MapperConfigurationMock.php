<?php

declare(strict_types=1);

namespace PHPClassMapper\Tests\Mocks\Configurations;

use PHPClassMapper\Configuration\MapperConfigurationInterface;
use PHPClassMapper\Configuration\MappingInterface;

final class MapperConfigurationMock implements MapperConfigurationInterface
{
    private MappingInterface $mapping;

    public function __construct(MappingInterface $mapping)
    {
        $this->mapping = $mapping;
    }

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
        return;
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
        return $this->mapping;
    }
}
