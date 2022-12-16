<?php

declare(strict_types=1);

namespace SharedKernel\Infrastructure\Aws\Sqs;

class DeliveryDelay
{
    private int $delay;

    public function __construct(int $delay)
    {
        if (0 > $delay) {
            throw new \RuntimeException('Cannot delay a message into the past!');
        }

        if (900 < $delay) {
            throw new \RuntimeException('Cannot delay SQS messages more than 15 minutes!');
        }

        $this->delay = $delay;
    }

    public function toInt(): int
    {
        return $this->delay;
    }
}