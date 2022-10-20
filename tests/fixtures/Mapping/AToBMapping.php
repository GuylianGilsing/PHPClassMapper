<?php

declare(strict_types=1);

namespace PHPClassMapper\Tests\Fixtures\Mapping;

use PHPClassMapper\Configuration\MappingInterface;
use PHPClassMapper\Exceptions\MissingMappingException;
use PHPClassMapper\MapperInterface;
use PHPClassMapper\Tests\Fixtures\Battery;
use PHPClassMapper\Tests\Fixtures\ChargeStatusDTO;

final class AToBMapping implements MappingInterface
{
    /**
     * Maps one class into another class.
     *
     * @param object $source The class that needs to be mapped to a different class.
     * @param array<string, mixed> $contextData An associative array (key => value) that gives the mapper additional
     * data to work with.
     *
     * @throws InvalidArgumentException when a `MyClass::name` string refers to a class that does not exist.
     * @throws MissingMappingException when a mapping between two class types can't be found.
     * @throws MissingContextDataFieldException when a specific context data field can't be found.
     */
    public function mapObject(object $source, array $contextData, MapperInterface $mapper): object
    {
        if (!($source instanceof Battery))
        {
            throw new MissingMappingException($source::class, ChargeStatusDTO::class);
        }

        return new ChargeStatusDTO($source->getBattery(), $source->getDevice());
    }
}
