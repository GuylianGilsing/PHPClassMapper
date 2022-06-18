<?php

declare(strict_types=1);

namespace PHPClassMapper;

use InvalidArgumentException;
use PHPClassMapper\Exceptions\MissingContextDataFieldException;
use PHPClassMapper\Exceptions\MissingMappingException;

interface MapperInterface
{
    /**
     * Maps one class into another class.
     *
     * @param object $source The class that needs to be mapped to a different class.
     * @param string $destinationClassName The `MyClass::name` string of the class that the mapper needs to return.
     * @param array<string, mixed> $contextData An associative array (key => value) that gives the mapper additional
     * data to work with.
     *
     * @throws InvalidArgumentException when a `MyClass::name` string refers to a class that does not exist.
     * @throws MissingMappingException when a mapping between two class types can't be found.
     * @throws MissingContextDataFieldException when a specific context data field can't be found.
     */
    public function map(object $source, string $destinationClassName, array $contextData = []): object;
}
