<?php

declare(strict_types=1);

namespace PHPClassMapper\Tests\Unit\Configuration;

use InvalidArgumentException;
use PHPClassMapper\Configuration\MapperConfiguration;
use PHPClassMapper\Configuration\MapperConfigurationInterface;
use PHPClassMapper\Exceptions\MissingMappingException;
use PHPClassMapper\Tests\Fixtures\AToBMapping\A;
use PHPClassMapper\Tests\Fixtures\AToBMapping\B;
use PHPClassMapper\Tests\Mocks\MappingConfigurations\SimpleMappingConfigurationMock;
use PHPUnit\Framework\TestCase;

final class MapperConfigurationTest extends TestCase
{
    public function testIfCanRegisterAndRetrieveConfiguration(): void
    {
        // Arrange
        $mapperConfiguration = $this->getMapperConfiguration();
        $mock = new SimpleMappingConfigurationMock();

        // Act
        $mapperConfiguration->addMapping(A::class, B::class, $mock);
        $addedConfiguration = $mapperConfiguration->getMapping(A::class, B::class);

        // Assert
        $this->assertEquals($mock, $addedConfiguration);
    }

    public function testIfCannotAddAlreadyExistingConfiguration(): void
    {
        // Arrange
        $mapperConfiguration = $this->getMapperConfiguration();
        $mock = new SimpleMappingConfigurationMock();

        $mapperConfiguration->addMapping(A::class, B::class, $mock);

        // Assert
        $this->expectException(InvalidArgumentException::class);

        // Act
        $mapperConfiguration->addMapping(A::class, B::class, $mock);
    }

    public function testIfCannotGetNonExistingConfiguration(): void
    {
        // Arrange
        $mapperConfiguration = $this->getMapperConfiguration();

        // Assert
        $this->expectException(MissingMappingException::class);

        // Act
        $mapperConfiguration->getMapping(A::class, B::class);
    }

    private function getMapperConfiguration(): MapperConfigurationInterface
    {
        return new MapperConfiguration();
    }
}
