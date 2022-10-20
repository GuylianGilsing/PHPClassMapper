<?php

declare(strict_types=1);

namespace PHPClassMapper\Configuration;

use PHPClassMapper\ArrayMapperInterface;

interface ToArrayMappingInterface
{
    /**
     * Maps an object into an array.
     *
     * @param object $source The class that needs to be mapped to an array.
     * @param array<string, mixed> $contextData An associative array (key => value) that gives the mapper additional
     * data to work with.
     * @param ArrayMapperInterface $mapper An extra mapper instance to map objects with.
     *
     * @throws InvalidArgumentException when a `MyClass::name` string refers to a class that does not exist.
     * @throws MissingMappingException when a mapping between two class types can't be found.
     * @throws MissingContextDataFieldException when a specific context data field can't be found.
     *
     * @return array<mixed>
     */
    public function mapObject(object $source, array $contextData, ArrayMapperInterface $mapper): array;
}
