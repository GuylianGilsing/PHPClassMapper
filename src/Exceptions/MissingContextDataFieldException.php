<?php

declare(strict_types=1);

namespace PHPClassMapper\Exceptions;

use Exception;
use Throwable;

final class MissingContextDataFieldException extends Exception
{
    public function __construct(
        string $fieldName,
        int $code = 0,
        ?Throwable $previous = null
    ) {
        parent::__construct(
            "Missing context data field '".$fieldName."' is missing.",
            $code,
            $previous
        );
    }
}
