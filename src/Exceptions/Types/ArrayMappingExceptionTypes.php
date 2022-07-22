<?php

declare(strict_types=1);

namespace PHPClassMapper\Exceptions\Types;

enum ArrayMappingExceptionTypes: string
{
    case TO = 'To';
    case FROM = 'From';
}
