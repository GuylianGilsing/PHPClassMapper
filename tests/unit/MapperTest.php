<?php

declare(strict_types=1);

namespace PHPClassMapper\Tests\Unit;

use InvalidArgumentException;
use PHPClassMapper\Configuration\MapperConfigurationInterface;
use PHPClassMapper\Configuration\MappingInterface;
use PHPClassMapper\Mapper;
use PHPClassMapper\MapperInterface;
use PHPClassMapper\Tests\Fixtures\NotRequiredFixture;
use PHPClassMapper\Tests\Mocks\Configurations\MapperConfigurationMock;
use PHPClassMapper\Tests\Mocks\MappingConfigurations\SimpleMappingConfigurationMock;
use PHPUnit\Framework\TestCase;
use stdClass;

final class MapperTest extends TestCase
{
    public function testIfCannotMapNonExistingClass(): void
    {
        // Arrange
        $object = new stdClass();
        $mapper = $this->getMapper(new SimpleMappingConfigurationMock());

        // Assert
        $this->expectException(InvalidArgumentException::class);

        // Act
        $mapper->map($object, NotRequiredFixture::class);
    }

    private function getMapper(MappingInterface $mapping): MapperInterface
    {
        return new Mapper(new MapperConfigurationMock($mapping));
    }
}
