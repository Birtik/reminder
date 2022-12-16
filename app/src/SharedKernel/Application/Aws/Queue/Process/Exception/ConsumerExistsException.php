<?php

declare(strict_types=1);

namespace SharedKernel\Application\Aws\Queue\Process\Exception;

final class ConsumerExistsException extends \RuntimeException
{
    /**
     * @param string $action
     *
     * @return ConsumerExistsException
     */
    public static function fromAction(string $action): self
    {
        return new self(sprintf('Consumer for action "%s" is already set', $action));
    }
}
