<?php

declare(strict_types=1);

namespace Progress\Application\View;

use JsonSerializable;

final class FinishedDayView implements JsonSerializable
{
    public function __construct(
        private string $date,
        private string $activity,
    ) {
    }

    public function jsonSerialize(): array
    {
        return [
            'date' => $this->date,
            'activity' => $this->activity,
        ];
    }
}