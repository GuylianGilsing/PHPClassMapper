<?php

declare(strict_types=1);

namespace PHPClassMapper\Tests\Unit\Exceptions;

use PHPClassMapper\Exceptions\MissingMappingException;
use PHPClassMapper\Tests\Fixtures\AToBMapping\A;
use PHPClassMapper\Tests\Fixtures\AToBMapping\B;
use PHPUnit\Framework\TestCase;

final class MissingMappingExceptionTest extends TestCase
{
    public function testIfExceptionMessageIsCorrect(): void
    {
        // Arrange
        $expectedMessage = "Mapping for '".A::class."' to '".B::class."' is missing.";

        // Assert
        $this->expectException(MissingMappingException::class);
        $this->expectErrorMessage($expectedMessage);

        // Act
        throw new MissingMappingException(A::class, B::class);
    }
}
