<?php

declare(strict_types=1);

namespace PHPClassMapper\Exceptions;

use Exception;
use Throwable;

final class MissingMappingException extends Exception
{
    public function __construct(
        string $sourceClassName,
        string $destinationClassName,
        int $code = 0,
        ?Throwable $previous = null
    ) {
        parent::__construct(
            "Mapping for '".$sourceClassName."' to '".$destinationClassName."' is missing.",
            $code,
            $previous
        );
    }
}
