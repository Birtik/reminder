<?php

declare(strict_types=1);

namespace SharedKernel\Application\Aws\Queue\Process;

use SharedKernel\Application\Aws\Queue\Message;

interface Consumer
{
    /**
     * @return string
     */
    public function getAction(): string;

    /**
     * @param Message $message
     */
    public function process(Message $message): void;
}