<?php

declare(strict_types=1);

namespace SharedKernel\Application\Aws\Queue\Process\Exception;

use RuntimeException;
use Throwable;

final class DelayMessageException extends RuntimeException
{
    private int $delay = 0;
    

    public function getDelay(): int
    {
        return $this->delay;
    }
}