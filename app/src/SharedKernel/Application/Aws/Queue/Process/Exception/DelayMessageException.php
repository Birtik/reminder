<?php

declare(strict_types=1);

namespace SharedKernel\Application\Aws\Queue\Process\Exception;

use RuntimeException;
use Throwable;

final class DelayMessageException extends RuntimeException
{
    private const MAX_DELAY_TIME = 900; // max AWS SQS delay time in seconds
    private const FIVE_MINUTES_IN_SECONDS = 300;
    private const TEN_MINUTES_IN_SECONDS = 600;

    private int $delay = 0;

    public static function fiveMinutes(Throwable $e): self
    {
        return self::withDelay(self::FIVE_MINUTES_IN_SECONDS, $e->getMessage(), $e->getCode(), $e);
    }

    public static function tenMinutes(Throwable $e): self
    {
        return self::withDelay(self::TEN_MINUTES_IN_SECONDS, $e->getMessage(), $e->getCode(), $e);
    }

    public static function fifteenMinutes(Throwable $e): self
    {
        return self::withDelay(self::MAX_DELAY_TIME, $e->getMessage(), $e->getCode(), $e);
    }

    public static function withDelay(
        int $delay,
        string $message = '',
        int $code = 0,
        ?Throwable $previous = null
    ): self {
        $exception = new self($message, $code, $previous);
        $exception->delay = $delay;

        return $exception;
    }

    public function getDelay(): int
    {
        return $this->delay;
    }
}