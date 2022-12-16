<?php

declare(strict_types=1);

namespace SharedKernel\Application\Aws\Queue\Message\Exception;

use RuntimeException;
use Throwable;

final class PropertyNotFoundException extends RuntimeException
{
    /**
     * @param string         $key
     * @param Throwable|null $previous
     */
    public function __construct(string $key, ?Throwable $previous = null)
    {
        parent::__construct("Property by key \"$key\" not found", 0, $previous);
    }
}