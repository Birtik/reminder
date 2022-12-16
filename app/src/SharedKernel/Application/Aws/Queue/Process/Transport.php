<?php

declare(strict_types=1);

namespace SharedKernel\Application\Aws\Queue\Process;

use SharedKernel\Application\Aws\Queue\Message;
use SharedKernel\Infrastructure\Aws\Sqs\SqsMessage;

interface Transport
{
    /**
     * @param string $queue
     *
     * @return Message[]
     */
    public function getMessages(string $queue): array;
    public function remove(string $queue, SqsMessage $message): void;
    public function sendMessage(SqsMessage $message, string $queue, int $delay = 0): void;
}