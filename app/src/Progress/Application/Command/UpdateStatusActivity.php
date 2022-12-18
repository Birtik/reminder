<?php

declare(strict_types=1);

namespace Progress\Application\Command;

final class UpdateStatusActivity
{
    public function __construct(private int $activityIdentifier)
    {
    }

    public function getActivityIdentifier(): int
    {
        return $this->activityIdentifier;
    }
}