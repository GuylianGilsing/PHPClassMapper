<?php

declare(strict_types=1);

namespace PHPClassMapper\Exceptions;

use Exception;
use PHPClassMapper\Exceptions\Types\ArrayMappingExceptionTypes;
use Throwable;

final class MissingArrayMappingException extends Exception
{
    public function __construct(
        string $className,
        ArrayMappingExceptionTypes $type,
        int $code = 0,
        ?Throwable $previous = null
    ) {
        parent::__construct(
            $type->value." array mapping for '".$className."' is missing.",
            $code,
            $previous
        );
    }
}
