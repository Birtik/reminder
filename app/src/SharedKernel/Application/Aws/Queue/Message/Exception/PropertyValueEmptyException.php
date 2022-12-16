<?php

declare(strict_types=1);

namespace SharedKernel\Application\Aws\Queue\Message\Exception;

use RuntimeException;
use Throwable;

final class PropertyValueEmptyException extends RuntimeException
{
    public function __construct(string $key, ?Throwable $previous = null)
    {
        parent::__construct("Property by key \"$key\" have empty value", 0, $previous);
    }
}
