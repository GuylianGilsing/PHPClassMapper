<?php

declare(strict_types=1);

namespace PHPClassMapper\Tests\Integration;

use PHPClassMapper\Configuration\MapperConfiguration;
use PHPClassMapper\Mapper;
use PHPClassMapper\MapperInterface;
use PHPClassMapper\Tests\Fixtures\Battery;
use PHPClassMapper\Tests\Fixtures\ChargeStatusDTO;
use PHPClassMapper\Tests\Fixtures\Device;
use PHPClassMapper\Tests\Fixtures\ExtraContextMapping\ExtraContentMapping;
use PHPClassMapper\Tests\Fixtures\Mapping\AToBMapping;
use PHPUnit\Framework\TestCase;

final class MapperTest extends TestCase
{
    public function testIfCanMapFromAToB(): void
    {
        // Arrange
        $configuration = new MapperConfiguration();
        $configuration->addMapping(Battery::class, ChargeStatusDTO::class, new AToBMapping());

        $device = new Device(1, 'phone');
        $battery = new Battery(39, $device);

        $expectedDTO = new ChargeStatusDTO($battery->getBattery(), $device);
        $mapper = $this->getMapper($configuration);

        // Act
        $dto = $mapper->map($battery, ChargeStatusDTO::class);

        // Assert
        $this->assertInstanceOf(ChargeStatusDTO::class, $dto);
        $this->assertEquals($expectedDTO, $dto);
    }

    public function testIfCanMapWithContext(): void
    {
        // Arrange
        $configuration = new MapperConfiguration();
        $configuration->addMapping(ChargeStatusDTO::class, Battery::class, new ExtraContentMapping());

        $device = new Device(1, 'phone');
        $expectedBattery = new Battery(39, $device);

        $dto = new ChargeStatusDTO($expectedBattery->getBattery(), $device);
        $mapper = $this->getMapper($configuration);

        // Act
        $battery = $mapper->map($dto, Battery::class, [
            'deviceId' => 1,
            'deviceName' => 'phone'
        ]);

        // Assert
        $this->assertInstanceOf(Battery::class, $battery);
        $this->assertEquals($expectedBattery, $battery);
    }

    private function getMapper(MapperConfiguration $configuration): MapperInterface
    {
        return new Mapper($configuration);
    }
}
