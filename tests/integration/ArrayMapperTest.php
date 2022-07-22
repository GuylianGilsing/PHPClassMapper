<?php

declare(strict_types=1);

namespace PHPClassMapper\Tests\Integration;

use PHPClassMapper\ArrayMapper;
use PHPClassMapper\ArrayMapperInterface;
use PHPClassMapper\Configuration\ArrayMapperConfiguration;
use PHPClassMapper\Configuration\ArrayMapperConfigurationInterface;
use PHPClassMapper\Tests\Fixtures\Device;
use PHPClassMapper\Tests\Fixtures\Mapping\FromArrayMapping;
use PHPClassMapper\Tests\Fixtures\Mapping\ToArrayMapping;
use PHPUnit\Framework\TestCase;

final class ArrayMapperTest extends TestCase
{
    public function testIfCanMapToArray(): void
    {
        // Arrange
        $configuration = new ArrayMapperConfiguration();
        $configuration->addToArrayMapping(Device::class, new ToArrayMapping());

        $mapper = $this->getMapper($configuration);

        $device = new Device(1, 'name');

        // Act
        $mappedArray = $mapper->toArray($device);

        // Assert
        $this->assertIsArray($mappedArray);

        $this->assertArrayHasKey('id', $mappedArray);
        $this->assertArrayHasKey('name', $mappedArray);

        $this->assertEquals($device->getId(), $mappedArray['id']);
        $this->assertEquals($device->getName(), $mappedArray['name']);
    }

    public function testIfCanMapFromArray(): void
    {
        // Arrange
        $configuration = new ArrayMapperConfiguration();
        $configuration->addFromArrayMapping(Device::class, new FromArrayMapping());

        $mapper = $this->getMapper($configuration);

        $unmappedArray = [
            'id' => 1,
            'name' => 'test'
        ];

        // Act
        $device = $mapper->fromArray($unmappedArray, Device::class);

        // Assert
        $this->assertEquals($unmappedArray['id'], $device->getId());
        $this->assertEquals($unmappedArray['name'], $device->getName());
    }

    private function getMapper(ArrayMapperConfigurationInterface $configuration): ArrayMapperInterface
    {
        return new ArrayMapper($configuration);
    }
}
