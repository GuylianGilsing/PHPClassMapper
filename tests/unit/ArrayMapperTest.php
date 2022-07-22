<?php

declare(strict_types=1);

namespace PHPClassMapper\Tests\Unit;

use InvalidArgumentException;
use PHPClassMapper\ArrayMapper;
use PHPClassMapper\ArrayMapperInterface;
use PHPClassMapper\Configuration\ArrayMapperConfiguration;
use PHPClassMapper\Exceptions\MissingArrayMappingException;
use PHPClassMapper\Tests\Fixtures\Device;
use PHPClassMapper\Tests\Fixtures\NotRequiredFixture;
use PHPUnit\Framework\TestCase;

final class ArrayMapperTest extends TestCase
{
    public function testIfCannotMapNonExistingToArray(): void
    {
        // Arrange
        $mapper = $this->getMapper();
        $device = new Device(1, 'test');

        // Assert
        $this->expectException(MissingArrayMappingException::class);

        // Act
        $mapper->toArray($device);
    }

    public function testIfCannotMapNotExistingFromArray(): void
    {
        // Arrange
        $mapper = $this->getMapper();

        // Assert
        $this->expectException(MissingArrayMappingException::class);

        // Act
        $mapper->fromArray([], Device::class);
    }

    public function testIfCannotMapNonExistingClassFromArray(): void
    {
        // Arrange
        $mapper = $this->getMapper();

        // Assert
        $this->expectException(InvalidArgumentException::class);

        // Act
        $mapper->fromArray([], NotRequiredFixture::class);
    }

    private function getMapper(): ArrayMapperInterface
    {
        return new ArrayMapper(new ArrayMapperConfiguration());
    }
}
