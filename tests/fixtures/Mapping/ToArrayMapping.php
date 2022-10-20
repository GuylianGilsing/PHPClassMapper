<?php

declare(strict_types=1);

namespace PHPClassMapper\Tests\Fixtures\Mapping;

use PHPClassMapper\ArrayMapperInterface;
use PHPClassMapper\Configuration\ToArrayMappingInterface;
use PHPClassMapper\Tests\Fixtures\Device;

final class ToArrayMapping implements ToArrayMappingInterface
{
    /**
     * @param object $source The class that needs to be mapped to an array.
     * @param array<string, mixed> $contextData An associative array (key => value) that gives the mapper additional
     * data to work with.
     *
     * @throws InvalidArgumentException when a `MyClass::name` string refers to a class that does not exist.
     * @throws MissingMappingException when a mapping between two class types can't be found.
     * @throws MissingContextDataFieldException when a specific context data field can't be found.
     */
    public function mapObject(object $source, array $contextData = [], ArrayMapperInterface $mapper): array
    {
        if ($source instanceof Device)
        {
            return [
                'id' => $source->getId(),
                'name' => $source->getName(),
            ];
        }
    }
}
