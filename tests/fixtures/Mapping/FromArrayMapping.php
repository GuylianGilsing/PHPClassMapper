<?php

declare(strict_types=1);

namespace PHPClassMapper\Tests\Fixtures\Mapping;

use PHPClassMapper\ArrayMapperInterface;
use PHPClassMapper\Configuration\FromArrayMappingInterface;
use PHPClassMapper\Tests\Fixtures\Device;

final class FromArrayMapping implements FromArrayMappingInterface
{
    /**
     * @param array<string, mixed> $source The class that needs to be mapped to a different class.
     * @param array<string, mixed> $contextData An associative array (key => value) that gives the mapper additional
     * data to work with.
     *
     * @throws MissingMappingException when a mapping between two class types can't be found.
     * @throws MissingContextDataFieldException when a specific context data field can't be found.
     */
    public function mapObject(array $source, array $contextData, ArrayMapperInterface $mapper): object
    {
        return new Device($source['id'], $source['name']);
    }
}
