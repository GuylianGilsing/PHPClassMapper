<?php

declare(strict_types=1);

namespace PHPClassMapper\Tests\Unit\Exceptions;

use PHPClassMapper\Exceptions\MissingContextDataFieldException;
use PHPUnit\Framework\TestCase;

final class MissingContextDataFieldExceptionTest extends TestCase
{
    public function testIfExceptionMessageIsCorrect(): void
    {
        // Arrange
        $expectedMessage = "Missing context data field 'MyTestField' is missing.";

        // Assert
        $this->expectException(MissingContextDataFieldException::class);
        $this->expectErrorMessage($expectedMessage);

        // Act
        throw new MissingContextDataFieldException('MyTestField');
    }
}
