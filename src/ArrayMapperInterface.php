<?php

declare(strict_types=1);

namespace PHPClassMapper;

interface ArrayMapperInterface
{
    /**
     * Maps an array into a class.
     *
     * @param array<string, mixed> $source The array that needs to be mapped to a class.
     * @param string $destinationClassName The `MyClass::name` string of the class that the mapper needs to return.
     * @param array<string, mixed> $contextData An associative array (key => value) that gives the mapper additional
     * data to work with.
     *
     * @throws InvalidArgumentException when a `MyClass::name` string refers to a class that does not exist.
     * @throws MissingMappingException when a mapping between two class types can't be found.
     * @throws MissingContextDataFieldException when a specific context data field can't be found.
     */
    public function fromArray(array $source, string $destinationClassName, array $contextData = []): object;

    /**
     * Maps a class into an array.
     *
     * @param object $source The class that needs to be mapped into an array.
     * @param array<string, mixed> $contextData An associative array (key => value) that gives the mapper additional
     * data to work with.
     *
     * @throws MissingMappingException when a mapping between two class types can't be found.
     * @throws MissingContextDataFieldException when a specific context data field can't be found.
     *
     * @return array<mixed>
     */
    public function toArray(object $source, array $contextData = []): array;
}
