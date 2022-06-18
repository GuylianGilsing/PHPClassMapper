<?php

declare(strict_types=1);

namespace PHPClassMapper\Tests\Mocks\MappingConfigurations;

use PHPClassMapper\Configuration\MappingInterface;
use stdClass;

final class SimpleMappingConfigurationMock implements MappingInterface
{
    private object $objectToReturn;

    public function __construct(object $objectToReturn = new stdClass())
    {
        $this->objectToReturn = $objectToReturn;
    }

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
    public function mapObject(object $source, array $contextData): object
    {
        return $this->objectToReturn;
    }
}
