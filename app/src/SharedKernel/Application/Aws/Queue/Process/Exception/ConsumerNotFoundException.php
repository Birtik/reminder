<?php

declare(strict_types=1);

namespace SharedKernel\Application\Aws\Queue\Process\Exception;

final class ConsumerNotFoundException extends \RuntimeException
{
    /**
     * @param string $action
     *
     * @return ConsumerNotFoundException
     */
    public static function fromAction(string $action): self
    {
        return new self(sprintf('Consumer for action "%s" do not exists', $action));
    }
}
