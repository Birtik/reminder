<?php

declare(strict_types=1);

namespace Progress\Application\View;

use JsonSerializable;

final class FinishedDaysViewCollection implements JsonSerializable
{
    private array $finishedDays;

    public function __construct(FinishedDayView ...$finishedDayView)
    {
        $this->finishedDays = $finishedDayView;
    }

    public function jsonSerialize(): array
    {
        return $this->finishedDays;
    }
}