<?php

declare(strict_types=1);

namespace PHPClassMapper\Tests\Fixtures\ExtraContextMapping;

use PHPClassMapper\Configuration\MappingInterface;
use PHPClassMapper\Exceptions\MissingContextDataFieldException;
use PHPClassMapper\Exceptions\MissingMappingException;
use PHPClassMapper\Tests\Fixtures\Battery;
use PHPClassMapper\Tests\Fixtures\ChargeStatusDTO;
use PHPClassMapper\Tests\Fixtures\Device;

final class ExtraContentMapping implements MappingInterface
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
    public function mapObject(object $source, array $contextData): object
    {
        if (!($source instanceof ChargeStatusDTO))
        {
            throw new MissingMappingException($source::class, Battery::class);
        }

        if (!isset($contextData['deviceId']))
        {
            throw new MissingContextDataFieldException('deviceId');
        }

        if (!isset($contextData['deviceName']))
        {
            throw new MissingContextDataFieldException('deviceName');
        }

        $device = new Device($contextData['deviceId'], $contextData['deviceName']);
        return new Battery($source->getBattery(), $device);
    }
}
