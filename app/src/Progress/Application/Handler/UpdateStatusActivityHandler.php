<?php

declare(strict_types=1);

namespace Progress\Application\Handler;

use Progress\Application\Command\UpdateStatusActivity;
use Progress\Domain\Repository\DayRepository;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

final class UpdateStatusActivityHandler implements MessageHandlerInterface
{
    public function __construct(private DayRepository $dayRepository)
    {
    }

    public function __invoke(UpdateStatusActivity $command)
    {
        $day = $this->dayRepository->findOneByActivity($command->getActivityIdentifier());
        $this->dayRepository->update($day);
    }
}
