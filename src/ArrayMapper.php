<?php

declare(strict_types=1);

namespace PHPClassMapper;

use InvalidArgumentException;
use PHPClassMapper\Configuration\ArrayMapperConfigurationInterface;

final class ArrayMapper implements ArrayMapperInterface
{
    private ArrayMapperConfigurationInterface $configuration;

    public function __construct(ArrayMapperConfigurationInterface $configuration)
    {
        $this->configuration = $configuration;
    }

    /**
     * @param array<string, mixed> $source The array that needs to be mapped to a class.
     * @param string $destinationClassName The `MyClass::name` string of the class that the mapper needs to return.
     * @param array<string, mixed> $contextData An associative array (key => value) that gives the mapper additional
     * data to work with.
     *
     * @throws InvalidArgumentException when a `MyClass::name` string refers to a class that does not exist.
     * @throws MissingMappingException when a mapping between two class types can't be found.
     * @throws MissingContextDataFieldException when a specific context data field can't be found.
     */
    public function fromArray(array $source, string $destinationClassName, array $contextData = []): object
    {
        if (!class_exists($destinationClassName))
        {
            throw new InvalidArgumentException("Destination class name '".$destinationClassName."' does not exist.");
        }

        $mapping = $this->configuration->getFromArrayMapping($destinationClassName);

        return $mapping->mapObject($source, $contextData, $this);
    }

    /**
     * @param object $source The class that needs to be mapped into an array.
     * @param array<string, mixed> $contextData An associative array (key => value) that gives the mapper additional
     * data to work with.
     *
     * @throws MissingMappingException when a mapping between two class types can't be found.
     * @throws MissingContextDataFieldException when a specific context data field can't be found.
     *
     * @return array<mixed>
     */
    public function toArray(object $source, array $contextData = []): array
    {
        $mapping = $this->configuration->getToArrayMapping($source::class);

        return $mapping->mapObject($source, $contextData, $this);
    }
}
