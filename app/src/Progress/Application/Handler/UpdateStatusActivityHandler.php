<?php

declare(strict_types=1);

namespace Progress\Application\Handler;

use Progress\Application\Command\UpdateStatusActivity;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

final class UpdateStatusActivityHandler implements MessageHandlerInterface
{
    public function __invoke(UpdateStatusActivity $command)
    {
        // TODO: Implement __invoke() method.
    }
}